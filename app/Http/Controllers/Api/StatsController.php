<?php

namespace App\Http\Controllers\Api;

use App\Models\Consumed;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StatsController extends ApiController
{
    /**
     * Get the stats for the drinks that have been dunk
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $user = Auth::user();
        $consumed = Consumed::with('drink')
            ->where('user_id', $user->id)
            ->get();

        $data = collect([
            'max' => 500,
            'total' => 0,
            'left' => 0,
        ]);

        foreach ($consumed as $cons) {
            $total = $data->get('total') ?? 0;
            $amount = $cons->amount * $cons->drink->caffeine;
            $data->put('total', $total + $amount);
        }

        $data->put('left', $data->get('max') - $data->get('total'));

        return new JsonResource($data);
    }
}
