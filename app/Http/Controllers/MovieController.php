<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Movie;
use App\Models\Category;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\User;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $query = Movie::query();

    if ($search = request()->query('search')) {
        $query->where('movieName', 'like', '%' . $search . '%');
    }

    $sortBy = request()->query('sort_by');
    if ($sortBy === 'rating_asc') {
        $query->orderBy('movieRating', 'asc');
    } elseif ($sortBy === 'rating_desc') {
        $query->orderBy('movieRating', 'desc');
    } else {
        $query->orderBy('movieName');
    }

    $movies = $query->get();
    $ratings = Rating::all();

    return view('movies.index', compact('movies', 'ratings'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = new Movie();
        $movie->movieUrl = $request->movieUrl;
        $movie->movieName = $request->movieName;
        $movie->movieDescription = $request->movieDescription;

        if ($request->hasFile('movieImage')) {
            $movieImage = $request->file('movieImage');
            $fileName = $movieImage->getClientOriginalName();
            $movieImage->move(public_path('images'), $fileName);
            $movie->movieImage = $fileName;
        }

        $movie->save();

        return redirect()->route('movies.index')->with('message', 'Movie created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $ratings = Rating::all();
        $categories = Category::all();
        return view('movies.show', compact('movie',"ratings","categories"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $ratings = Rating::all();
        $averageRating = 0;
        $count = 0;
        foreach ($ratings as $rating) {
            if ($rating->movie_id == $movie->id) {
                $averageRating += $rating->rating;
                $count++;
            }
        }
        if ($count > 0) {
            $averageRating /= $count;
        }
        $movie->movieRating = $averageRating;
        $movie->save();
        
        return redirect()->back()->with('message', 'Movie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
