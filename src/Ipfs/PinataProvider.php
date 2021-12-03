<?php

namespace Superciety\ElrondSdk\Ipfs;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

final class PinataProvider implements IProvider
{
    const ApiBaseUrl = 'https://api.pinata.cloud';

    public function addFile($contents, string $filename): IpfsContentId
    {
        $res = $this->getHttpClient()
            ->attach('file', $contents, $filename)
            ->post(static::ApiBaseUrl . '/pinning/pinFileToIPFS')
            ->throw()
            ->json();

        return new IpfsContentId($res['IpfsHash']);
    }

    public function addMetadata(string $description, string $fileType, string $fileUri, string $fileName): IpfsContentId
    {
        $res = $this->getHttpClient()
            ->post(static::ApiBaseUrl . '/pinning/pinJSONToIPFS', [
                'description' => $description,
                'fileType' => $fileType,
                'fileUri' => $fileUri,
                'fileName' => $fileName,
            ])
            ->throw()
            ->json();

        return new IpfsContentId($res['IpfsHash']);
    }

    private function getHttpClient(): PendingRequest
    {
        return Http::withToken(config('elrond.ipfs.providers.pinata.bearer_token'));
    }
}
