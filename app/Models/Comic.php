<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'url',
    ];

    public function detail(){
        return $this->hasOne(ComicDetail::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class)->orderBy('order','DESC');
    }

    public function categories(){
        return $this->belongsToMany(Category::class)->orderBy('title','ASC');
    }
}
