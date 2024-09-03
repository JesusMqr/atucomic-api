<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable =[
        'order',
        'serie_id'
    ];

    public function images(){
        return $this->hasMany(Image::class)->orderBy('order');
    }
    public function serie(){
        return $this->belongsTo(Serie::class);
    }
}
