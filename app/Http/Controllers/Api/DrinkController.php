<?php

namespace App\Http\Controllers\Api;

use App\Facades\Services\DrinkService;
use App\Http\Requests\DrinkStoreRequest;
use App\Http\Requests\DrinkUpdateRequest;
use App\Http\Resources\DrinkResource;
use App\Models\Drink;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Controller class to handle drinks requests
 * @package App\Http\Controllers\Api
 */
class DrinkController extends ApiController
{
    /**
     * Get a list of all drinks
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $user = Auth::user();

        return DrinkResource::collection($user->drinks);
    }

    /**
     * Show a single drink by id
     *
     * @param Drink $drink
     * @return DrinkResource
     */
    public function show(Drink $drink): DrinkResource
    {
        Gate::authorize('drink', $drink);

        return new DrinkResource($drink);
    }

    /**
     * Create a single drink entry
     *
     * @param DrinkStoreRequest $request
     * @return DrinkResource
     */
    public function store(DrinkStoreRequest $request): DrinkResource
    {
        $data = $request->validated();
        $drink = DrinkService::addDrink($data['name'], $data['description'], $data['order']);

        return new DrinkResource($drink);
    }

    /**
     * Update the given drink
     *
     * @param DrinkUpdateRequest $request
     * @param Drink $drink
     * @return DrinkResource
     */
    public function update(DrinkUpdateRequest $request, Drink $drink): DrinkResource
    {
        Gate::authorize('drink', $drink);

        $data = $request->validated();
        DrinkService::updateDrink($drink, $data);

        return new DrinkResource($drink);
    }

    /**
     * Populate the standard drinks for the logged in user
     *
     * @return AnonymousResourceCollection
     */
    public function populate(): AnonymousResourceCollection
    {
        $drinks = DrinkService::populateDefaults();
        return DrinkResource::collection($drinks);
    }

    /**
     * Delete the given drink item
     *
     * @param Drink $drink
     * @return Response
     */
    public function destroy(Drink $drink): Response
    {
        Gate::authorize('drink', $drink);
        $drink->delete();

        return response()->noContent();
    }
}
