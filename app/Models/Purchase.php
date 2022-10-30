<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $fillable = ['invoice', 'tanggal', 'supplier_id', 'total','diskon', 'tipe_transaksi', 'status', ''];


    public function customer()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}
