<?php

namespace App\Http\Controllers\Api;

use App\Facades\Services\ConsumedService;
use App\Http\Requests\ConsumedStoreRequest;
use App\Http\Requests\ConsumedUpdateRequest;
use App\Http\Resources\ConsumedResource;
use App\Models\Consumed;
use App\Models\Drink;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class ConsumedController
 * @package App\Http\Controllers\Api
 */
class ConsumedController extends ApiController
{
    /**
     * Get a list of all consumed
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $user = Auth::user();
        $consumed = Consumed::where('user_id', $user->id)->get();
        $consumed->load('drink');

        return ConsumedResource::collection($consumed);
    }

    /**
     * Show the given consumed
     *
     * @param Consumed $consumed
     * @return ConsumedResource
     */
    public function show(Consumed $consumed): ConsumedResource
    {
        Gate::authorize('consumed', $consumed);
        return new ConsumedResource($consumed);
    }

    /**
     * Store a single consumed entry
     *
     * @param ConsumedStoreRequest $request
     * @return ConsumedResource
     */
    public function store(ConsumedStoreRequest $request): ConsumedResource
    {
        $data = $request->validated();
        $drink = Drink::where('id', $data['drinkId'])->first();
        Gate::authorize('drink', $drink);

        $consumed = ConsumedService::addConsumed($data['drinkId'], $data['amount']);

        return new ConsumedResource($consumed);
    }

    /**
     * Update a single consumed entry
     *
     * @param ConsumedUpdateRequest $request
     * @param Consumed $consumed
     * @return ConsumedResource
     */
    public function update(ConsumedUpdateRequest $request, Consumed $consumed): ConsumedResource
    {
        Gate::authorize('consumed', $consumed);

        $data = $request->validated();
        ConsumedService::updateConsumed($consumed, $data);

        return new ConsumedResource($consumed);
    }

    /**
     * Delete the given consumed record
     *
     * @param Consumed $consumed
     * @return Response
     */
    public function destroy(Consumed $consumed): Response
    {
        Gate::authorize('consumed', $consumed);
        $consumed->delete();

        return response()->noContent();
    }
}
