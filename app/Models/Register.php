<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Register extends Model
{
    use HasFactory;

    public function registerDetail(): HasMany{
        return $this->hasMany(Register_Detail::class);
    }
}
