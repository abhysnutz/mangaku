<?php

namespace App\Models\Comic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicRecomendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id',
        'order',
    ];

    public function comic(){
        return $this->belongsTo(Comic::class);
    }
}
