<?php

namespace App\Services;

use App\Models\Drink;
use Illuminate\Support\Facades\Auth;

/**
 * Service class to help handle drink tasks
 *
 * @package App\Services
 */
class DrinkService
{
    /**
     * Add a new drink to the authenticated user's drink list
     *
     * @param string $name
     * @param string $description
     * @param int|null $order
     * @return Drink
     */
    public function addDrink(string $name, string $description, int $order = null): Drink
    {
        $user = Auth::user();
        $order = $order ?? 1;

        return Drink::create([
            'user_id' => $user->id,
            'name' => $name,
            'description' => $description,
            'order' => $order,
        ]);
    }

    /**
     * Update the drink with the supplied values in data
     *
     * @param Drink $drink
     * @param array $data
     * @return void
     */
    public function updateDrink(Drink $drink, array $data): void
    {
        if ($data['name'] ?? false) {
            $drink->name = $data['name'];
        }

        if ($data['description'] ?? false) {
            $drink->description = $data['description'];
        }

        if ($data['order'] ?? false) {
            $drink->order = $data['order'];
        }

        $drink->save();
    }
}
