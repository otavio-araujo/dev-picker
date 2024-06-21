<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeveloperNote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
