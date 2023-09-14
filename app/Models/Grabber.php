<?php

namespace App\Models;

use App\Models\Audit\AuditGrabber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grabber extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artisan',
    ];

    public function audits(){
        return $this->hasMany(AuditGrabber::class);
    }

    public function queues(){
        return $this->hasMany(Queue::class);
    }
}
