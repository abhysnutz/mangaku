<?php

namespace App\Models\Audit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'tags',
        'msg',
        'ip_address',
        'user_agent',
    ];
}
