<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapMaterial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ["date", "tipe_rekap", "nama_material", "persediaan", "pemakaian", "sisa", "harga_satuan", "total"];


    #################################################################
    #####                   Model Scopes                        #####
    #################################################################
    public function scopeSearch($query, $search)
    {
        return $query->orWhere("nama_material", "like", "%{$search}%");
    }

}
