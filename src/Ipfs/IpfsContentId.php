<?php

namespace Superciety\ElrondSdk\Ipfs;

class IpfsContentId
{
    public function __construct(
        public string $value,
    ) {
    }

    public function getNativeUri(): string
    {
        return "ipfs://{$this->value}";
    }

    public function getFirstPartyPublicGatewayUri(): string
    {
        return "https://ipfs.io/ipfs/{$this->value}";
    }
}
