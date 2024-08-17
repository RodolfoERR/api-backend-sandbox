<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Register_Detail extends Model
{
    use HasFactory;
    protected $table = 'register_details';

    public function register(): BelongsTo{
        return $this->belongsTo(Register::class);
    }

    public function refaction(): BelongsTo{
        return $this->belongsTo(Refaction::class, 'refaction_id', 'id');
    }
}
