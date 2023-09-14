<?php

namespace App\Models;

use App\Models\Comic\Comic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'comic_id',
        'alias',
        'description',
        'status',
        'type',
        'released',
        'author',
        'artist',
        'serialization',
        'posted_by',
        'posted_on',
        'rating',
        'follower',
        'view',
        'image',
        'bg_image',
        'project',
        'color',
    ];

    public function comic(){
        return $this->hasOne(Comic::class, 'id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_comic', 'comic_id', 'category_id');
    }
}
