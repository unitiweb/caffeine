<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consumed extends Model
{
    use HasFactory;

    /**
     * The table name for this model
     * @var string
     */
    public $table = 'consumed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'drink_id',
        'amount',
        'drank_at',
    ];

    /**
     * Get the related drink
     *
     * @return BelongsTo
     */
    public function drink(): BelongsTo
    {
        return $this->belongsTo(Drink::class);
    }
}
