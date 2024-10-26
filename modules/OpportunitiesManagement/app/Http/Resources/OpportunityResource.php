<?php

namespace Modules\OpportunitiesManagement\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpportunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->map( function ($item)  {
            return [
                'id' => $item->id,
                'related_customer' => $item->related_customer,
                'status' => $item->getStatus($item->status),
                'cost' => $item->cost,
                'title' => $item->title,
                'createdBy' => $item->createdBy,
            ];
        })->all();

    }
}
