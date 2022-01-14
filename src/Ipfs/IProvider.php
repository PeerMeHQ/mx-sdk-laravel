<?php

namespace Superciety\ElrondSdk\Ipfs;

interface IProvider
{
    public function addFile(string $filename, $contents): IpfsContentId;

    public function addFileInDirectory(string $filename, $contents): IpfsContentId;
}
