<?php

namespace Superciety\ElrondSdk\Http\Converters;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\Entities\NftCollectionAccount;

class NftCollectionAccountResponseConverter
{
    public static function single(NftCollectionAccount $nftCollection): array
    {
        return [
            'collection' => $nftCollection->collection,
            'type' => $nftCollection->type,
            'name' => $nftCollection->name,
            'ticker' => $nftCollection->ticker,
            'canFreeze' => $nftCollection->canFreeze,
            'canWipe' => $nftCollection->canWipe,
            'canPause' => $nftCollection->canPause,
            'canTransferRole' => $nftCollection->canTransferRole,
            'canCreate' => $nftCollection->canCreate,
            'canBurn' => $nftCollection->canBurn,
        ];
    }

    public static function many(Collection $tokens): array
    {
        return collect($tokens)
            ->map(fn ($tokens) => self::single($tokens))
            ->toArray();
    }
}
