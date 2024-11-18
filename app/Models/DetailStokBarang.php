<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStokBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ["stok_name", "data_pembelian_barang_id", "jumlah", "harga_satuan", "harga_total"];

    #################################################################
    #####                      Relations                        #####
    #################################################################
    public function data_pembelian_barang()
    {
        return $this->belongsTo(DataPembelianBarang::class);
    }

    #################################################################
    #####                   Model Scopes                        #####
    #################################################################
    public function scopeSearch($query, $search)
    {
        return $query->orWhere("stok_name", "like", "%{$search}%");
    }
}
