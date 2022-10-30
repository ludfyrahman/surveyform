<?php

namespace App\Constants;

class SaleStatus
{
    public const PROSES = 'Proses';
    public const DONE = 'Done';

    public const TYPE = [
        self::PROSES => "Proses",
        self::DONE => "Done"
    ];
}
