<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class applicationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'projects_id' => $this->projects_id,
            'status' => $this->status,
            'groups_id' => $this->groups_id,
            'isApproved' => $this->isApproved,
            
      
        ];
    }
}
