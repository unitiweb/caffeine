<?php

namespace App\Services;

use App\Models\Consumed;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class ConsumedService
 * @package App\Services
 */
class ConsumedService
{
    /**
     * Create a consumed entry
     *
     * @param int $drinkId
     * @param int $amount
     * @return Consumed
     */
    public function addConsumed(int $drinkId, int $amount): Consumed
    {
        $user = Auth::user();

        return Consumed::create([
            'user_id' => $user->id,
            'drink_id' => $drinkId,
            'amount' => $amount,
            'drank_at' => new Carbon(),
        ]);
    }

    /**
     * Update the given consumed model with the values in data
     *
     * @param Consumed $consumed
     * @param array $data
     * @return void
     */
    public function updateConsumed(Consumed $consumed, array $data): void
    {
        if ($data['amount'] ?? false) {
            $consumed->amount =  $data['amount'];
        }

        $consumed->save();
    }
}
