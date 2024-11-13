<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilInputOperator extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "schedule_id", "lb_black", "bat", "pem"];

    #################################################################
    #####                      Relations                        #####
    #################################################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    #################################################################
    #####                   Model Scopes                        #####
    #################################################################
    public function scopeSearch($query, $search)
    {
        return $query->orWhere("lb_black", "like", "%{$search}%")->orWhere("bat", "like", "%{$search}%")->orWhere("pem", "like", "%{$search}%");
    }
}
