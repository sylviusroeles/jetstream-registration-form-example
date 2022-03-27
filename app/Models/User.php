<?php

namespace App\Models;

use App\Services\PostCodeApi;
use Cache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $initials
 * @property string $last_name
 * @property string $zip_code
 * @property string $house_number
 * @property string $email
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn() => sprintf("%s %s %s", $this->initial, $this->first_name, $this->last_name),
        );
    }

    /**
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return new Attribute(
            set: fn($value) => \Hash::make($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function address(): Attribute
    {
        return new Attribute(
            get: fn() => (new PostCodeApi())->getAddress($this->zip_code, $this->house_number),
        );
    }
}
