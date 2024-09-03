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
        "image",
    ];

    public function chapters(){
        return $this->hasMany(Chapter::class)->orderBy('order','desc');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
