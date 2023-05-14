<?php

namespace Aldijakaria\LaravelActivityLog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable = [
        'description', 'url', 'method', 'ip', 'agent', 'user_id', 'param'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
