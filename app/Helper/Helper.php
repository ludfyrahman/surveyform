<?php
namespace App\Helper;

use App\Models\Jasa;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ProfileCompany;
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

    public static function profile(){
        return ProfileCompany::first();
    }

    public static function tanggal($tgl)
    {
        $qq = '';
        // $dt = explode(" ", $tgl);
        $k = explode("-", $tgl);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $qq = $k[2] . ' ' . $bln[(int)$k[1]] . ' ' . $k[0];
        return $qq;
    }

    public static function tanggalWaktu($tgl)
    {
        $qq = '';
        $dt = explode(" ", $tgl);
        $k = explode("-", $dt[0]);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $qq = $k[2] . ' ' . $bln[(int)$k[1]] . ' ' . $k[0] . ' ' . $dt[1];
        return $qq;
    }
}
