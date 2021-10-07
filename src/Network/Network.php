<?php

namespace Superciety\ElrondSdk\Network;

use Illuminate\Support\Facades\Http;
use Superciety\ElrondSdk\Network\Responses\Economics;

class Network
{
    public function __construct(
        private string $baseUrl
    ) {}

    public function getEconomics(): Economics
    {
        $res = Http::get("{$this->baseUrl}/economics")
            ->throw()
            ->json();

        return Economics::fromResponse($res);
    }
}
