<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refaction extends Model
{
    use HasFactory;

    protected $hidden = [
        'type_id',
        'location_id'
    ];

    public function type(): BelongsTo{
        return $this->belongsTo(Type::class);
    }

    public function location(): BelongsTo{
        return $this->belongsTo(Shelf::class);
    }
}
