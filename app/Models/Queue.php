<?php

namespace App\Models;

use App\Models\Audit\AuditQueue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'grabber_id',
        'title',
        'ref_id',
        'status',
        'finished_at',
    ];

    public function grabber(){
        return $this->belongsTo(Grabber::class);
    }

    public function audits(){
        return $this->hasMany(AuditQueue::class)->orderBy('id', 'DESC');
    }
}
