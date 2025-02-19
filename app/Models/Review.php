<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'user_id', 'rating', 'comment'];

    // Relación con Game
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    // Relación con User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
