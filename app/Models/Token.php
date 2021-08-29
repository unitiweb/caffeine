<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Token extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'type',
        'token',
        'data',
        'expiresAt',
    ];

    /**
     * Add attribute for getting the value using camelCase
     *
     * @return int
     */
    public function getUserIdAttribute(): int
    {
        return $this->attributes['user_id'];
    }

    /**
     * Add attribute for setting the value using camelCase
     *
     * @param int $userId
     * @return void
     */
    public function setUserIdAttribute(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    /**
     * Add attribute for getting the value using camelCase
     *
     * @return string
     */
    public function getExpiresAtAttribute(): string
    {
        return $this->attributes['expires_at'];
    }

    /**
     * Add attribute for setting the value using camelCase
     *
     * @param Carbon $userId
     * @return void
     */
    public function setExpiresAtAttribute(Carbon $userId): void
    {
        $this->attributes['expires_at'] = $userId;
    }

    /**
     * Get the related user for this token
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
