<?php

namespace App\Models;

use App\Models\Comic\Comic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function comics(){
        return $this->belongsToMany(Comic::class);
    }
}
