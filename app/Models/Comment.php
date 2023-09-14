<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'comic_id',
        'chapter_id',
        'parent_id',
        'status',
    ];

    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
