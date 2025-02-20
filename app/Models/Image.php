<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'image_url',
        'chapter_id',
    ];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
}
