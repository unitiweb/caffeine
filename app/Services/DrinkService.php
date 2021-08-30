<?php

namespace App\Services;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Collection;
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

    public function populateDefaults(): Collection
    {
        $user = Auth::user();

        $data = [
            [
                'user_id' => $user->id,
                'name' => 'Monster Ultra Sunrise',
                'description' => 'A refreshing orange beverage that has 75mg of caffeine per serving. Every can has two servings.',
                'order' => 1,
            ], [
                'user_id' => $user->id,
                'name' => 'Black Coffee',
                'description' => 'The classic, the average 8oz. serving of black coffee has 95mg of caffeine.',
                'order' => 2,
            ], [
                'user_id' => $user->id,
                'name' => 'Americano',
                'description' => 'Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine per serving.',
                'order' => 3,
            ], [
                'user_id' => $user->id,
                'name' => 'Sugar free NOS',
                'description' => 'Another orange delight without the sugar. It has 130 mg. per serving and each can has two servings.',
                'order' => 4,
            ], [
                'user_id' => $user->id,
                'name' => '5 Hour Energy',
                'description' => 'And amazing shot of get up and go! Each 2 fl. oz. container has 200mg of caffeine to get you going.',
                'order' => 5,
            ]
        ];

        if (Drink::where('user_id', $user->id)->count() === 0) {
            foreach ($data as $drink) {
                Drink::create($drink);
            }
        }

        return Drink::where('user_id', $user->id)->get();
    }
}
