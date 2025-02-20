<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GameListController extends Controller
{

    public function index()
    {
        return view('web.lists', ['lists' => auth()->user()->gameLists ]);
    }

    public function show(GameList $list)
    {
        return view('web.list', ['list' => $list]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $list = auth()->user()->gameLists()->create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Lista creada con éxito.');
    }

    public function addGame(GameList $list, Game $game)
    {
        if ($list->user_id !== auth()->id()) {
            abort(403);
        }

        $list->games()->syncWithoutDetaching([$game->id]);

        return redirect()->back()->with('success', 'Juego añadido a la lista.');
    }

    public function destroy(GameList $list)
    {
        Gate::authorize('delete', $list);

        $list->delete();

        return redirect()->route('lists.index')->with('success', 'Lista eliminada con éxito.');
    }

    public function showtoadd(Game $game)
    {
        $lists = auth()->user()->gameLists()->whereDoesntHave('games', function ($query) use ($game) {
            $query->where('games.id', $game->id);
        })->get();

        return view('web.liststoadd', ['lists' => $lists, 'game' => $game]);
    }

    public function addGameToList(GameList $list, Game $game) {
        //Política para comprobar que la lista es del usuario autenticado
        Gate::authorize('addGame', $list);

        //Comprobar que el juego no esté ya en la lista
        if ($list->games->contains($game)) {
            return redirect()->route('lists.show', ['list' => $list->id]);
        }

        $list->games()->attach($game);
        return redirect()->route('lists.show', ['list' => $list->id]);
    }

    public function removeGameFromList(GameList $list, Game $game) {
        //Política para comprobar que la lista es del usuario autenticado
        Gate::authorize('deleteGame', $list);

        $list->games()->detach($game);
        return redirect()->route('lists.show', ['list' => $list->id]);
    }


}
