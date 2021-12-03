<?php

namespace App\Models\AdminPanel\Review\Enums;

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
}