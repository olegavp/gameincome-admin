<?php

namespace App\Models\AdminPanel\Review\Enums;

use App\Models\Product\Item\Game;
use App\Models\Product\Item\Skin;
use App\Models\Product\Item\Software;

class ItemTypeEnum
{
    const ITEM_GAME = 'game';
    const ITEM_SOFTWARE = 'software';
    const ITEM_SKIN = 'skin';

    const ITEM_TYPES = [
        self::ITEM_GAME => 'Игра',
        self::ITEM_SOFTWARE => 'Программа',
        self::ITEM_SKIN => 'Скин',
    ];

    public static function getQuery(string $type): ?\Illuminate\Database\Eloquent\Builder
    {
        if ($type === self::ITEM_GAME) {
            return Game::query();
        } elseif ($type === self::ITEM_SOFTWARE) {
            return Software::query();
        } elseif ($type === self::ITEM_SKIN) {
            return Skin::query();
        } else {
            return null;
        }
    }
}