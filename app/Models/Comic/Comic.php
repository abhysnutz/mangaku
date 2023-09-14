<?php

namespace App\Models\Comic;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\ComicDetail;
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
        return $this->hasMany(Chapter::class);
    }

    public function chaptersDown(){
        return $this->hasMany(Chapter::class)->orderBy('order','DESC');
    }

    public function categories(){
        return $this->belongsToMany(Category::class)->orderBy('title','ASC');
    }

    public function trending(){
        return $this->hasMany(ComicTrending::class);
    }

    public function popular(){
        return $this->hasMany(ComicPopular::class);
    }

    public function scopeLast($query){
        return $this->chapters()->oldest();
    }
}
