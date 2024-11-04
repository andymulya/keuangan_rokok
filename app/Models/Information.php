<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];


    #################################################################
    #####                      Relations                        #####
    #################################################################

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
