<?php

namespace App\Http\Resources;

use App\Models\UsageItem;
use Illuminate\Http\Resources\Json\JsonResource;

class UsageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'usage_items' => UsageItemResource::collection($this->whenLoaded('usageItems'))
        ];
    }
}
