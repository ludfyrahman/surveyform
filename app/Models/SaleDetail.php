<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $table = 'penjualan_detail';
    protected $fillable = ['item_id', 'jumlah', 'harga', 'harga','sub_total', 'tipe', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function service()
    {
        return $this->belongsTo(Jasa::class, 'item_id');
    }

}
