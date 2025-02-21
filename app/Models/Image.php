<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user():BelongsTo{
        return $this->belongsTo(User::class,'owner_id');
    }
}
