<?php

namespace Superciety\ElrondSdk\Ipfs;

class IpfsContentId
{
    public function __construct(
        public string $value,
    ) {
    }

    public function getNativeUri(string $filename = ''): string
    {
        return trim("ipfs://{$this->value}/{$filename}", '/');
    }

    public function getFirstPartyPublicGatewayUri(string $filename = ''): string
    {
        return trim("https://ipfs.io/ipfs/{$this->value}/{$filename}", '/');
    }
}
