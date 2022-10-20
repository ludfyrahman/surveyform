<?php
namespace App\Helper;

use App\Models\Jasa;
use App\Models\Product;
use Carbon\Carbon;

class Helper{

    public static function kodeJasa(){
        $jasa = Jasa::latest('id')->first();
        $kode =0;
        if ($jasa) {
            $last = $jasa->id+1;
            $kode = 'JS'.str_pad($last, 3, 0, STR_PAD_LEFT);
        } else {
            $kode = 'JS001';
        }

        return $kode;
    }

    public static function kodeProduk(){
        $prod = Product::latest('id')->first();
        $kode =0;
        if ($prod) {
            $last = $prod->id+1;
            $kode = 'BR'.str_pad($last, 4, 0, STR_PAD_LEFT);
        } else {
            $kode = 'BR0001';
        }

        return $kode;
    }

    public static function kodeJual()
    {
        $time = Carbon::now();
        return 'TRS'.date_format($time,'hisdmY');
    }

    public static function kodeBeli()
    {
        $time = Carbon::now();
        return 'TRB'.date_format($time,'hisdmY');
    }

    public static function rupiah($angka){

        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;

    }
}
