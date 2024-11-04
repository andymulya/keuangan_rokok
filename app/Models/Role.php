<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use ReflectionClass;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    const ADMIN = "Administrator";
    const GUEST = "Guest";

    public static function getDefaultRoles()
    {
        return [
            self::ADMIN,
            self::GUEST,
        ];
    }


    #################################################################
    #####                      Relations                        #####
    #################################################################

    public function information()
    {
        return $this->belongsToMany(Information::class);
    }

    #################################################################
    #####                    Model Scopes                       #####
    #################################################################

    public function scopeSearch($query, $search)
    {
        return $query->orWhere("name", "like", "%{$search}%");
    }
}
