<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Hooks for model lifecycle
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uid = (string) Str::uuid();
        });
    }

    /**
     * Get the current api token if one exists
     *
     * @return HasOne
     */
    public function apiToken(): HasOne
    {
        return $this->hasOne(Token::class)->where('type', 'api');
    }

    public function drinks(): HasMany
    {
        return $this->hasMany(Drink::class)
            ->orderBy('order')
            ->orderBy('name');
    }
}
