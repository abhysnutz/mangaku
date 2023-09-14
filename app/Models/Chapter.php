<?php

namespace App\Models;

use App\Models\Comic\Comic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id',
        'slug',
        'episode',
        'title',
        'order',
        'views',
        'url',
    ];

    public function comic(){
        return $this->belongsTo(Comic::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
