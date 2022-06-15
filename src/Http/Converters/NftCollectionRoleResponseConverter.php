<?php

namespace Superciety\ElrondSdk\Http\Converters;

use Illuminate\Support\Collection;
use Superciety\ElrondSdk\Api\Entities\NftCollectionRole;

class NftCollectionRoleResponseConverter
{
    public static function single(NftCollectionRole $nftCollectionRole): array
    {
        return [
            'collection' => $nftCollectionRole->collection,
            'type' => $nftCollectionRole->type,
            'name' => $nftCollectionRole->name,
            'ticker' => $nftCollectionRole->ticker,
            'owner' => $nftCollectionRole->owner->bech32(),
            'canFreeze' => $nftCollectionRole->canFreeze,
            'canWipe' => $nftCollectionRole->canWipe,
            'canPause' => $nftCollectionRole->canPause,
            'canTransferNftCreateRole' => $nftCollectionRole->canTransferNftCreateRole,
            'canCreate' => $nftCollectionRole->canCreate,
            'canBurn' => $nftCollectionRole->canBurn,
            'canAddQuantity' => $nftCollectionRole->canAddQuantity,
            'canUpdateAttributes' => $nftCollectionRole->canUpdateAttributes,
            'canAddUri' => $nftCollectionRole->canAddUri,
            'canTransferRole' => $nftCollectionRole->canTransferRole,
        ];
    }

    public static function many(Collection $tokens): array
    {
        return collect($tokens)
            ->map(fn ($tokens) => self::single($tokens))
            ->toArray();
    }
}
