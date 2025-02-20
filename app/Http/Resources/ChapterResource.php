<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'chapter',
            'attributes' => [
                'order_number' => $this->order_number,
                'created_at'=>$this->created_at,
                'image' => $this->image_url,
            ],
            'relationships' => [
                'images' => new ImageCollection($this->images),
                'serie'=>[
                    'id'=>$this->serie->id,
                    'name'=>$this->serie->title,
                ]
            ],
        ];
    }
}
