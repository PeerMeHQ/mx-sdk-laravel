<?php

namespace Superciety\ElrondSdk\Ipfs;

interface IProvider
{
    public function addFile($contents, string $filename): IpfsContentId;

    public function addMetadata(string $description, string $fileType, string $fileUri, string $fileName): IpfsContentId;
}
