<?php

namespace App\Models\Audit;

use App\Models\Grabber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditGrabber extends Model
{
    use HasFactory;

    protected $fillable = [
        'grabber_id',
        'url',
        'msg',
        'error_msg',
    ];

    public function grabber(){
        return $this->belongsTo(Grabber::class);
    }
}
