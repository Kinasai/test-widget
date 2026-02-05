<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'customer' => $this->whenLoaded('customer'),
            'title' => $this->title,
            'text' => $this->text,
            'status' => $this->status,
            'status_label' => $this->status->label(),
            'response_date' => $this->response_date != null ? Carbon::parse($this->response_date)->setTimezone('Europe/Moscow')->format('d.m.Y H:i:s T P') : null,
            'created_at' => $this->created_at != null ? Carbon::parse($this->created_at)->setTimezone('Europe/Moscow')->format('d.m.Y H:i:s T P') : null,
            'updated_at' => $this->updated_at != null ? Carbon::parse($this->updated_at)->setTimezone('Europe/Moscow')->format('d.m.Y H:i:s T P') : null,
        ];
    }
}
