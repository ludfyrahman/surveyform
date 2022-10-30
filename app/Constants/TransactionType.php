<?php

namespace App\Constants;

class TransactionType
{
    public const ONLINE = 'Online';
    public const OFFLINE = 'Offline';

    public const TRANSAKSI = [
        self::ONLINE,
        self::OFFLINE
    ];
}
