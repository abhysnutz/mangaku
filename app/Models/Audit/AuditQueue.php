<?php

namespace App\Models\Audit;

use App\Models\Queue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'url',
        'status',
        'msg',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
}
