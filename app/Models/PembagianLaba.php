<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianLaba extends Model
{
    use HasFactory;

    public function periode()
    {
        return $this->belongsTo(PeriodeLaporan::class);
    }
}
