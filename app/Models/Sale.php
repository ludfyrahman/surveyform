<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = ['invoice', 'tanggal', 'customer_id', 'total','diskon', 'tipe_transaksi', 'status', ''];


    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
