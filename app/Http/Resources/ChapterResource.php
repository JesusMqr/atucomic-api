<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Chapter;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Find the previous and next chapters based on order_number
        $previousChapter = Chapter::where('serie_id', $this->serie_id)
            ->where('order_number', '<', $this->order_number)
            ->orderBy('order_number', 'desc')
            ->first();

        $nextChapter = Chapter::where('serie_id', $this->serie_id)
            ->where('order_number', '>', $this->order_number)
            ->orderBy('order_number', 'asc')
            ->first();

        return [
            'id' => $this->id,
            'type' => 'chapter',
            'attributes' => [
                'order_number' => $this->order_number,
                'created_at' => $this->created_at,
                'image' => $this->image_url,
            ],
            'relationships' => [
                'images' => new ImageCollection($this->images),
                'serie' => [
                    'id' => $this->serie->id,
                    'name' => $this->serie->title,
                    'type' => $this->serie->type,
                ],
                'previous_chapter' => $previousChapter ? $previousChapter->id : null,
                'next_chapter' => $nextChapter ? $nextChapter->id : null,
            ],
        ];
    }
}
