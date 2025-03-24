<?php

namespace App\Http\Controllers;

use App\Models\Watchlater;
use App\Models\Movie;
use App\Http\Requests\StoreWatchlaterRequest;
use App\Http\Requests\UpdateWatchlaterRequest;

class WatchlaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laters = Watchlater::all();
        $movies = Movie::all();
        return view('watchlater.index', compact('laters', 'movies'));
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
    public function store(StoreWatchlaterRequest $request)
    {
        if (!Watchlater::where('movie_id', $request->movie_id)
            ->where('user_id', $request->user_id)
            ->exists()) {
            $later = new Watchlater();
            $later->movie_id = $request->movie_id;
            $later->user_id = $request->user_id;
     
            $later->save();
        }

        return redirect()->route('movies.show', $request->movie_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Watchlater $watchlater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Watchlater $watchlater)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWatchlaterRequest $request, Watchlater $watchlater)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchlater $watchlater)
    {
        //
    }
}
