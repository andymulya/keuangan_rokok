<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * @var array<int, string>
     */
    protected $appends = ['profile_information', 'role_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    #################################################################
    #####                     Attributes                        #####
    #################################################################

    public function getProfileInformationAttribute()
    {
        return $this->roles
            ->first()
            ->information
            ->map(function ($info) {
                $profile = $this->profile->where('id', $info->id)->first();
                $info->value = '-';
                if (isset($profile)) {
                    $info->value = $profile->pivot->value;
                }
                return $info;
            });
    }

    public function getRoleNameAttribute()
    {
        return $this->roles->first()->name;
    }

    #################################################################
    #####                      Relations                        #####
    #################################################################

    public function profile()
    {
        return $this->belongsToMany(Information::class, 'user_information')
            ->withPivot('value');
    }

    public function faculty()
    {
        return $this->belongsToMany(Faculty::class, 'faculty_administrators', 'user_id');
    }

    public function operator()
    {
        return $this->belongsToMany(HasilInputOperator::class);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }

    #################################################################
    #####                   Model Scopes                        #####
    #################################################################

    /**
     * Search by Name or Email
     */
    public function scopeSearch($query, $search)
    {
        return $query->orWhere("name", "like", "%{$search}%")->orWhere("email", "like", "%{$search}%");
    }
}
