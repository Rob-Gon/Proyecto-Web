<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Word;
use App\Models\Category;

class Language extends Model
{
    use HasFactory;

    public function words() : HasMany
    {
        return $this->hasMany(Word::class);
    }

    public function categories() : HasMany
    {
        return $this->hasMany(Category::class);
    }
}
