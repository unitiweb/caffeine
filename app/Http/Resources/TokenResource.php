<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * Class TokenResource
 *
 * @package App\Http\Resources
 *
 * @property string type
 * @property string token
 * @property string data
 * @property Carbon expiresAt
 */
class TokenResource extends JsonResource
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
            'type' => $this->type,
            'token' => $this->token,
            'data' => $this->data,
            'expiresAt' => $this->expiresAt,
        ];
    }
}
