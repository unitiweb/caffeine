<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * A resource class for displaying the user data
 *
 * @package App\Http\Resources
 *
 * @property mixed id
 * @property mixed name
 * @property mixed email
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'apiToken' => new DrinkResource($this->whenLoaded('apiToken')),
        ];
    }
}
