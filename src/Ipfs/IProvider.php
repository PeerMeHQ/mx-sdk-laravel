<?php

namespace Peerme\Multiversx\Ipfs;

interface IProvider
{
    public function addFile(string $filename, $contents): IpfsContentId;

    public function addFileInDirectory(string $filename, $contents): IpfsContentId;
}
