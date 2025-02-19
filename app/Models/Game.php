<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'price', 'developer', 'release_date', 'trailer_url', 'rating', 'platform', 'genre'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
