<?php

namespace Peerme\MxLaravel\Auth;

class NativeAuthDecoded
{
    public function __construct(
        public int $ttl = 0,
        public string $origin = '',
        public string $address = '',
        public mixed $extraInfo = null,
        public string $signature = '',
        public string $blockHash = '',
        public string $body = '',
    ) {
    }
}
