<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;

class User extends Authenticatable implements LaratrustUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use \Laratrust\Traits\HasRolesAndPermissions;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }    /**
     * Get the path to the user's profile image
     *
     * @return string
     */
    public function adminlte_image()
    {
        // Check if profile image exists
        if ($this->profile_image && file_exists(public_path($this->profile_image))) {
            return asset($this->profile_image);
        }

        // Return default image if profile image is not set or file doesn't exist
        return asset('vendor/adminlte/dist/img/user2-160x160.jpg');
    }
}
