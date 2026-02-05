<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at != null ? Carbon::parse($this->created_at)->setTimezone('Europe/Moscow')->format('d.m.Y H:i:s T P') : null,
            'updated_at' => $this->updated_at != null ? Carbon::parse($this->updated_at)->setTimezone('Europe/Moscow')->format('d.m.Y H:i:s T P') : null,
        ];
    }
}
