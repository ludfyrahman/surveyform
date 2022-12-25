<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'barang';
    private $path = 'storage/product/';
    protected $fillable = ['satuan_id', 'kategori_id', 'kode', 'nama', 'harga_beli', 'harga_jual', 'stok', 'foto', 'expired_date', 'status', 'deskripsi','is_available_in','store'];

    public function kategori(){
        return $this->belongsTo(Type::class, 'kategori_id');
    }

    public function satuan(){
        return $this->belongsTo(Unit::class, 'satuan_id');
    }

    public function getFotoAttribute(){
        if($this->attributes['foto'] == null){
            return null;
        }else{
            return asset($this->path.$this->attributes['foto']);
        }
    }

    public function penjualan(){
        return $this->hasMany(SaleDetail::class, 'item_id');
    }


}
