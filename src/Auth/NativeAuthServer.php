<?php

namespace Peerme\MxLaravel\Auth;

use InvalidArgumentException;
use Peerme\Mx\Address;
use Peerme\Mx\SignableMessage;
use Peerme\Mx\Signature;
use Peerme\Mx\UserVerifier;
use Peerme\MxLaravel\Exceptions\NativeAuthInvalidSignatureException;
use Peerme\MxLaravel\Exceptions\NativeAuthInvalidTokenTtlException;
use Peerme\MxLaravel\Exceptions\NativeAuthOriginNotAcceptedException;
use Peerme\MxLaravel\Exceptions\NativeAuthTokenExpiredException;

class NativeAuthServer
{
    public function __construct(
        public ?string $apiUrl = null,
        public array $acceptedOrigins = [],
        public int $maxExpirySeconds = 86400,
        public bool $skipLegacyValidation = false,
    ) {
    }

    public function decode(string $accessToken): NativeAuthDecoded
    {
        $tokenComponents = explode('.', $accessToken);
        throw_unless(count($tokenComponents) === 3, InvalidArgumentException::class, 'invalid token');

        [$address, $body, $signature] = explode('.', $accessToken);
        $parsedAddress = base64_decode($this->unescape($address));
        $parsedBody = base64_decode($this->unescape($body));
        $bodyComponents = explode('.', $parsedBody);
        throw_unless(count($bodyComponents) === 4, InvalidArgumentException::class, 'invalid token');

        [$origin, $blockHash, $ttl, $extraInfo] = $bodyComponents;

        $parsedExtraInfo = $extraInfo === '{}' ? null : json_decode(base64_decode($this->unescape($extraInfo)), true);
        $parsedOrigin = base64_decode($this->unescape($origin));

        return new NativeAuthDecoded(
            ttl: (int) $ttl,
            origin: $parsedOrigin,
            address: $parsedAddress,
            extraInfo: $parsedExtraInfo,
            signature: $signature,
            blockHash: $blockHash,
            body: $parsedBody,
        );
      }

      public function validate(string $accessToken): NativeAuthValidateResult
      {
        $decoded = $this->decode($accessToken);

        throw_unless($decoded->ttl <= $this->maxExpirySeconds, NativeAuthInvalidTokenTtlException::class, $decoded->ttl, $this->maxExpirySeconds);

        $hasAcceptedOrigins = count($this->acceptedOrigins) > 0;
        $isInvalidOrigin = ! in_array($decoded->origin, $this->acceptedOrigins) && ! in_array('https://'.$decoded->origin, $this->acceptedOrigins);
        throw_if($hasAcceptedOrigins && $isInvalidOrigin, NativeAuthOriginNotAcceptedException::class, $decoded->origin);

        $this->ensureNotExpired($decoded);

        $verifiable = new SignableMessage(
            message: "{$decoded->address}{$decoded->body}",
            signature: new Signature($decoded->signature),
            address: Address::fromBech32($decoded->address),
        );

        $valid = UserVerifier::fromAddress(Address::fromBech32($decoded->address))
            ->verify($verifiable);

        if (! $valid && ! $this->skipLegacyValidation) {
            $verifiable = new SignableMessage(
                message: "{$decoded->address}{$decoded->body}{}",
                signature: new Signature($decoded->signature),
                address: Address::fromBech32($decoded->address),
            );

            $valid = UserVerifier::fromAddress(Address::fromBech32($decoded->address))
                ->verify($verifiable);
        }

        throw_unless($valid, NativeAuthInvalidSignatureException::class);

        return new NativeAuthValidateResult(
            issued: 1, // TODO implement as part of block timestamp & ttl verification
            expires: 1, // TODO implement as part of block timestamp & ttl verification
            origin: $decoded->origin,
            address: $decoded->address,
            extraInfo: $decoded->extraInfo,
        );
      }

    private function unescape(string $str): string
    {
        return str_replace(['-', '_'], ['+', '/'], $str);
    }

    private function ensureNotExpired(NativeAuthDecoded $decoded): void
    {
        if (isset($decoded->extraInfo['timestamp'])) {
            $timestamp = $decoded->extraInfo['timestamp'];
            $expiry = $timestamp + $decoded->ttl;
            $now = time();

            throw_if($expiry < $now, NativeAuthTokenExpiredException::class);
        }
    }
}
