<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPembelianBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ["date", "tipe_pembelian"];

    #################################################################
    #####                   Model Scopes                        #####
    #################################################################
    public function scopeSearch($query, $search)
    {
        return $query->orWhere("tipe_pembelian", "like", "%{$search}%");
    }
}
