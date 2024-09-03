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
                'title'=>$this->title,
                'description'=>$this->description,
                'image'=>$this->image,
                'author' =>$this->user->name,
                'updated_at'=>$this->updated_at,
            ],
            'relationships'=>[
                'chapters'=>new ChapterCollection($this->chapters)
            ]
        ];
    }
}
