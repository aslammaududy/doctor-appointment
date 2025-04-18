<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
