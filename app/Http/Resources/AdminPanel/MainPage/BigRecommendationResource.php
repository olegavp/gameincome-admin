<?php

namespace App\Http\Resources\AdminPanel\MainPage;

use Illuminate\Http\Resources\Json\JsonResource;

class BigRecommendationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
