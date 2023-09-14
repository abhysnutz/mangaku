<?php

namespace App\Models\Comic;

use App\Models\ComicDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicPopular extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'comic_id',
        'order',
    ];

    public function comic(){
        return $this->belongsTo(Comic::class);
    }

    public function detail(){
        return $this->belongsTo(ComicDetail::class, 'comic_id', 'comic_id');
    }

    public function scopeType($query, $value){
        return $this->detail();
    }
}
