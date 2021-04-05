<?php

namespace App\Http\Resources;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image_details' => $this->formatApiImages(),
            'category' => count($this->categories) ? $this->formatApiCategories() : [['category_title' => 'uncategorized']],
            'created_at' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}