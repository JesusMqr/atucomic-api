<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'type'=>'serie',
            'attributes'=>[
                'type'=>$this->type,
                'title'=>$this->title,
                'description'=>$this->description,
                'banner_image'=>$this->banner_image_url,
                'cover_image'=>$this->cover_image_url,
                'author' =>$this->author,
                'owner' =>$this->user->name,
                'status'=>$this->status,
                'updated_at'=>$this->updated_at,
            ],
            'relationships'=>[
                'chapters'=>new ChapterCollection($this->chapters)
            ]
        ];
    }
}
