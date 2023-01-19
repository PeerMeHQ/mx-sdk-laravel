<?php

namespace Peerme\MxLaravel\Http\Converters;

use Illuminate\Support\Collection;
use Peerme\MxProviders\Entities\Nft;

final class NftResponseConverter
{
    public static function single(Nft $nft): array
    {
        return [
            'identifier' => $nft->identifier,
            'collection' => $nft->collection,
            'nonce' => $nft->nonce,
            'type' => $nft->type,
            'name' => $nft->name,
            'creator' => $nft->creator,
            'ticker' => $nft->ticker,
            'royalties' => $nft->royalties,
            'url' => $nft->url,
            'thumbnailUrl' => $nft->thumbnailUrl,
            'owner' => $nft->owner,
            'supply' => $nft->supply,
            'tags' => $nft->getTags(),
            'description' => $nft->description,
        ];
    }

    public static function many(Collection $nfts): array
    {
        return collect($nfts)
            ->map(fn ($nft) => self::single($nft))
            ->toArray();
    }
}
