<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RandomMovieSeeder extends Seeder
{
    private $apiKey = '64ece30fdd443c46caf6536758fbe589'; // Replace with your TMDb API Key
    private $baseUrl = 'https://api.themoviedb.org/3/';
    private $totalPages = 500; // TMDb API supports up to 500 pages for many endpoints

    public function run()
    {
        $movies = $this->fetchRandomMovies(50);

        foreach ($movies as $movie) {
            DB::table('movies')->insert($this->formatMovie($movie));
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

            // Shuffle and pick movies from the random page
            shuffle($movies);

            foreach ($movies as $movie) {
                if (!in_array($movie['id'], $fetchedMovies)) {
                    $randomMovies[] = $movie;
                    $fetchedMovies[] = $movie['id'];

                    // Stop if we reach the required count
                    if (count($randomMovies) >= $count) {
                        break 2;
                    }
                }
            }
        }

        return $randomMovies;
    }

    private function formatMovie($movie)
    {
        return [
            'movieUrl' => "https://play2.123embed.net/movie/" . $this->fetchImdbId($movie['id']),
            'movieName' => $movie['title'],
            'movieDescription' => $movie['overview'],
            'movieImage' => 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function fetchImdbId($movieId)
    {
        $response = Http::get($this->baseUrl . "movie/{$movieId}", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
        ]);

        return $response->json()['imdb_id'] ?? null;
    }
}
