<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.games', [
            'games' => Game::paginate(8),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //Si el usuario logueado ya ha hecho una review no puede hacer otra
        $userReview = $game->reviews->where('user_id', auth()->id())->first();
        if ($userReview == null) {
            return view('web.game', [
                'game' => $game,
                'userReview' => false,
            ]);
        } else {
            return view('web.game', [
                'game' => $game,
                'userReview' => true,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }

    public function review(Request $request, Game $game)
    {
        if ($game->reviews->where('user_id', auth()->id())->first() != null) {
            return redirect()->route('games.show', $game);
        } else {
            $review = new Review();
            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->user_id = $request->user()->id;
            $review->game_id = $game->id;
            $review->save();

            return redirect()->route('games.show', $game);
        }
    }

}
