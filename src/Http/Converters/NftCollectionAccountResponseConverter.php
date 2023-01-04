<?php

namespace Peerme\MxLaravel\Http\Converters;

use Illuminate\Support\Collection;
use Peerme\Mx\Api\Entities\NftCollectionAccount;

class NftCollectionAccountResponseConverter
{
    public static function single(NftCollectionAccount $nftCollection): array
    {
        return [
            'collection' => $nftCollection->collection,
            'type' => $nftCollection->type,
            'name' => $nftCollection->name,
            'ticker' => $nftCollection->ticker,
            'owner' => $nftCollection->owner->bech32(),
            'canFreeze' => $nftCollection->canFreeze,
            'canWipe' => $nftCollection->canWipe,
            'canPause' => $nftCollection->canPause,
            'canTransferNftCreateRole' => $nftCollection->canTransferNftCreateRole,
        ];
    }

    public static function many(Collection $tokens): array
    {
        return collect($tokens)
            ->map(fn ($tokens) => self::single($tokens))
            ->toArray();
    }
}
