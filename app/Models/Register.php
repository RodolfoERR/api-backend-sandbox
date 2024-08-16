<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Register extends Model
{
    use HasFactory;

    public function registerDetail(): HasMany{
        return $this->hasMany(Register_Detail::class);
    }

    public function userDetails(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
