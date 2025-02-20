<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable =[
        'order_number',
        'image_url',
        'serie_id',
        //'owner_id'
    ];

    public function images(){
        return $this->hasMany(Image::class)->orderBy('order_number');
    }
    public function serie(){
        return $this->belongsTo(Serie::class,'serie_id');
    }
}
