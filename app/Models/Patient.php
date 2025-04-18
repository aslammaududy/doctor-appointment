<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'birth_date',
        'gender',
        'address'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(App\Models\User::class);
    }
}
