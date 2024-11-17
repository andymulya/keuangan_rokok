<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGajiKaryawan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function periode()
    {
        return $this->belongsTo(PeriodeLaporan::class);
    }
}
