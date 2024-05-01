<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Word;

class Translation extends Model
{
    use HasFactory;

    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
