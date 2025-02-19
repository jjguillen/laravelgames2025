<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GameList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    // Relación con el usuario
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con los juegos
    public function games(): belongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_list_game');
    }
}
