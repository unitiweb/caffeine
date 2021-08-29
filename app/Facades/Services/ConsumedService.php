<?php

namespace App\Facades\Services;

use App\Models\Consumed;
use Illuminate\Support\Facades\Facade;

/**
 * ConsumedService facade
 *
 * @package App\Facades\Services
 *
 * @method static Consumed addConsumed(int $drinkId, int $amount)
 * @method static void updateConsumed(Consumed $consumed, array $data)
 */
class ConsumedService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\ConsumedService::class;
    }
}
