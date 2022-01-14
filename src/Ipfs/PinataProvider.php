<?php

namespace Superciety\ElrondSdk\Ipfs;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

final class PinataProvider implements IProvider
{
    const ApiBaseUrl = 'https://api.pinata.cloud';

    public function addFile(string $filename, $contents): IpfsContentId
    {
        $res = $this->getHttpClient()
            ->attach('file', $contents, $filename)
            ->post(static::ApiBaseUrl . '/pinning/pinFileToIPFS')
            ->throw()
            ->json();

        return new IpfsContentId($res['IpfsHash']);
    }

    public function addFileInDirectory(string $filename, $contents): IpfsContentId
    {
        $res = $this->getHttpClient()
            ->attach('file', $contents, $filename)
            ->attach('pinataOptions', json_encode([
                'wrapWithDirectory' => true,
            ]))
            ->post(static::ApiBaseUrl . '/pinning/pinFileToIPFS')
            ->throw()
            ->json();

        return new IpfsContentId($res['IpfsHash']);
    }

    private function getHttpClient(): PendingRequest
    {
        return Http::withToken(config('elrond.ipfs.providers.pinata.bearer_token'));
    }
}
