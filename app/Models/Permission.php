<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    public static function getDefaultPermissions()
    {
        return [
            "dashboard" => [
                "index" => [
                    "description" => "Dapat mengakses dashboard",
                    "role" => [Role::ADMIN],
                ],
            ],
            "user" => [
                "index" => [
                    "description" => "Dapat mengakses data user",
                    "role" => [Role::ADMIN],
                ],
                "create" => [
                    "description" => "Dapat membuat data user",
                    "role" => [Role::ADMIN],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data user",
                    "role" => [Role::ADMIN],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data user",
                    "role" => [Role::ADMIN],
                ],
            ],
            "role" => [
                "index" => [
                    "description" => "Dapat mengakses data role",
                    "role" => [Role::ADMIN],
                ],
                "create" => [
                    "description" => "Dapat membuat data role",
                    "role" => [Role::ADMIN],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data role",
                    "role" => [Role::ADMIN],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data role",
                    "role" => [Role::ADMIN],
                ],
            ],

            "operator" => [
                "index" => [
                    "description" => "Dapat mengakses data operator",
                    "role" => [Role::ADMIN, Role::OPERATOR],
                ],
                "create" => [
                    "description" => "Dapat membuat data operator",
                    "role" => [Role::OPERATOR],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data operator",
                    "role" => [Role::ADMIN, Role::OPERATOR],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data operator",
                    "role" => [Role::ADMIN, Role::OPERATOR],
                ],
            ],

            "schedule" => [
                "index" => [
                    "description" => "Dapat mengakses data schedule",
                    "role" => [Role::ADMIN],
                ],
                "create" => [
                    "description" => "Dapat membuat data schedule",
                    "role" => [Role::ADMIN],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data schedule",
                    "role" => [Role::ADMIN],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data schedule",
                    "role" => [Role::ADMIN],
                ],
            ],

            "shift" => [
                "index" => [
                    "description" => "Dapat mengakses data shift",
                    "role" => [Role::ADMIN],
                ],
                "create" => [
                    "description" => "Dapat membuat data shift",
                    "role" => [Role::ADMIN],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data shift",
                    "role" => [Role::ADMIN],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data shift",
                    "role" => [Role::ADMIN],
                ],
            ],
            "rekap-material" => [
                "index" => [
                    "description" => "Dapat mengakses data rekap-material",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
                "create" => [
                    "description" => "Dapat membuat data rekap-material",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data rekap-material",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data rekap-material",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
            ],
            "data-pembelian" => [
                "index" => [
                    "description" => "Dapat mengakses data data-pembelian",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
                "create" => [
                    "description" => "Dapat membuat data data-pembelian",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
                "edit" => [
                    "description" => "Dapat mengedit data data-pembelian",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
                "delete" => [
                    "description" => "Dapat menghapus data data-pembelian",
                    "role" => [Role::ADMIN, Role::ADMIN_STOK],
                ],
            ],
        ];
    }
}
