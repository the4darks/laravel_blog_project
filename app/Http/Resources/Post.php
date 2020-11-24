<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{

    public function toArray($request)
    {
        if (is_null($this->likes)) {
            $this->likes = 0;
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'likes' => $this->likes,
            'photo' => $this->photo,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
