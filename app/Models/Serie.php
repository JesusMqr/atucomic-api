<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "type",
        "status",
        "author",
        "cover_image_url",
        "banner_image_url",

    ];

    public function chapters(){
        return $this->hasMany(Chapter::class)->orderBy('order_number','desc');
    }
    public function user(){
        return $this->belongsTo(User::class,'owner_id');
    }
}
