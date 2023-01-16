<?php

namespace App\Constants;

class ItemType
{
    public const JASA = 'Jasa';
    public const BARANG = 'Barang';
    public const PURCHASE = 'Purchase';

    public const TYPE = [
        self::JASA => "Jasa",
        self::BARANG => "Barang",
        self::PURCHASE => "Purchase"
    ];
}
