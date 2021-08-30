<?php

namespace App\Facades\Services;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * DrinkService facade
 *
 * @package App\Facades\Services
 *
 * @method static Drink addDrink(string $name, string $description, int $order = null)
 * @method static void updateDrink(Drink $drink, array $data)
 * @method static Collection populateDefaults()
 */
class DrinkService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\DrinkService::class;
    }
}
