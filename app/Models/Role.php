<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use ReflectionClass;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    const ADMIN = "Admin";
    const OPERATOR = "Operator";

    const ADMIN_STOK = "Admin Stok";

    public static function getDefaultRoles()
    {
        return [
            self::ADMIN,
            self::OPERATOR,
            self::ADMIN_STOK
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
