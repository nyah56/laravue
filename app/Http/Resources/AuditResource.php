<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'event'          => $this->event,
            'auditable_type' => $this->auditable_type,
            'auditable_id'   => $this->auditable_id,
            'user_id'        => $this->user_id,
            'old_values'     => $this->old_values,
            'new_values'     => $this->new_values,
            'url'            => $this->url,
            'ip_address'     => $this->ip_address,
            'user_agent'     => $this->user_agent,
            'created_at'     => $this->created_at,
        ];
    }
}
