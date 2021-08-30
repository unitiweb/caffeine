<?php

namespace App\Http\Controllers\Api;

use App\Models\Consumed;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StatsController extends ApiController
{
    /**
     * Get the stats for the drinks that have been dunk
     *
     * @return Response
     */
    public function index(): Response
    {
        $user = Auth::user();
        $consumed = Consumed::with('drink')
            ->where('user_id', $user->id)
            ->get();

        $data = [
            'max' => 500,
            'total' => 0,
            'left' => 0,
        ];

        foreach ($consumed as $cons) {
            $data['total'] += ($cons->amount * $cons->drink->caffeine);
        }

        $data['left'] = $data['max'] - $data['total'];

        return response(['data' => $data]);
    }
}
