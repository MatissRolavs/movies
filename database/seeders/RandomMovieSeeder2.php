<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use App\Models\Category;

class RandomMovieSeeder2 extends Seeder
{
    private $apiKey = '64ece30fdd443c46caf6536758fbe589'; // Replace with your TMDb API Key
    private $baseUrl = 'https://api.themoviedb.org/3/';
    private $totalPages = 500; // TMDb API supports up to 500 pages for many endpoints
    private $genres = [];

    public function run()
    {
        // Fetch movie genres and store them
        $this->genres = $this->fetchGenres();

        // Get random movies and insert them
        $movies = $this->fetchRandomMovies(50);
        foreach ($movies as $movie) {
            $this->storeMovieWithCategories($movie);
        }
    }

    private function storeMovieWithCategories($movie)
    {
        $storedMovie = Movie::create([
            'movieUrl' => "https://multiembed.mov/?video_id=" . $this->fetchImdbId($movie['id']),
            'movieName' => $movie['title'],
            'movieDescription' => $movie['overview'],
            'movieImage' => 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create categories linked to the movie
        foreach ($this->getGenreNames($movie['genre_ids'] ?? []) as $genreName) {
            Category::create([
                'name' => $genreName,
                'movie_id' => $storedMovie->id,
            ]);
        }
    }

    private function fetchRandomMovies($count)
    {
        $randomMovies = [];
        $fetchedMovies = [];

        while (count($randomMovies) < $count) {
            $randomPage = rand(1, $this->totalPages);
            $response = Http::get($this->baseUrl . 'movie/popular', [
                'api_key' => $this->apiKey,
                'language' => 'en-US',
                'page' => $randomPage,
            ]);

            $movies = $response->json()['results'] ?? [];

            shuffle($movies);

            foreach ($movies as $movie) {
                if (!in_array($movie['id'], $fetchedMovies)) {
                    $randomMovies[] = $movie;
                    $fetchedMovies[] = $movie['id'];

                    if (count($randomMovies) >= $count) {
                        break 2;
                    }
                }
            }
        }

        return $randomMovies;
    }

    private function fetchImdbId($movieId)
    {
        $response = Http::get($this->baseUrl . "movie/{$movieId}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        return $response->json()['imdb_id'] ?? null;
    }

    private function fetchGenres()
    {
        $response = Http::get($this->baseUrl . 'genre/movie/list', [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        $genres = $response->json()['genres'] ?? [];

        return collect($genres)->mapWithKeys(fn($genre) => [$genre['id'] => $genre['name']])->toArray();
    }

    private function getGenreNames($genreIds)
    {
        return array_map(fn($id) => $this->genres[$id] ?? 'Unknown', $genreIds);
    }
}
