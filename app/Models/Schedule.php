<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
