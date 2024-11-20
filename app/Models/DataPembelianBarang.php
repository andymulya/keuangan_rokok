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
    public function scopeSearch($query, $search, $date, $type)
    {
        return $query->where("date", "like", "%{$date}%")->where("tipe_pembelian", "=", "{$type}");
        // $query->where("tipe_rekap", "=", "{$tipe}")->where("nama_material", "like", "%{$search}%");
    }

    public static function getDataPembelian($date, $type)
    {
        return self::where("date", "=", $date)->where("tipe_pembelian", "like", "%{$type}%")->first();
    }

    public static function getDataWithType($type){
        return self::where("tipe_pembelian", "like", "%{$type}%")->get();
    }
}
