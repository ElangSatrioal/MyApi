<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "news_content" => $this->news_content,
            "created_at" => date('Y-m-d H:i:s', $this->created_at),
            "author_id" => $this->whenLoaded('writer')->id,
            "writer" => $this->whenLoaded('writer')->firstname
        ];
    }
}
