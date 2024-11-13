<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "shift", "date", "absen"];

    #################################################################
    #####                      Relations                        #####
    #################################################################
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #################################################################
    #####                   Model Scopes                        #####
    #################################################################
    public function scopeSearch($query, $search)
    {
        return $query->orWhere("shift", "like", "%{$search}%")->orWhere("absen", "like", "%{$search}%");
    }

    public static function getScheduleDateNow()
    {
        $dateNow = Carbon::now()->setTimeZone('Asia/Jakarta')->format('Y-m-d');

        return Schedule::where("date", "=", $dateNow)->get();
    }
}
