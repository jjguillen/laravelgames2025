<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameListCollection;
use App\Http\Resources\GameListResource;
use App\Models\Game;
use App\Models\GameList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    public function index()
    {
        return GameListResource::collection(auth()->user()->gameLists);
    }

    public function store(Request $request)
    {
        $list = auth()->user()->gameLists()->create([
            'name' => $request->name,
        ]);

        return new GameListResource($list);
    }

    public function destroy(GameList $list)
    {
        Gate::authorize('delete', $list);
        $list->delete();

        return response(["name" => $list->name, "deleted" => true], Response::HTTP_OK);
    }

    public function addGame(GameList $list, Game $game)
    {
        //Política para comprobar que la lista es del usuario autenticado
        Gate::authorize('addGame', $list);

        //Comprobar que el juego no esté ya en la lista
        if ($list->games->contains($game)) {
            return response("Ya está en la lista", Response::HTTP_BAD_REQUEST);
        }

        $list->games()->attach($game);

        return response(["name" => $list->name, "game" => $game], Response::HTTP_OK);
    }

    public function removeGame(GameList $list, Game $game)
    {
        //Política para comprobar que la lista es del usuario autenticado
        Gate::authorize('deleteGame', $list);

        //Comprobar que el juego esté en la lista
        if (!$list->games->contains($game)) {
            return response("No está en la lista", Response::HTTP_BAD_REQUEST);
        }

        $list->games()->detach($game);

        return response("Deleted", Response::HTTP_OK);
    }
}
