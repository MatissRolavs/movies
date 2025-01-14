<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    private $apiKey = '64ece30fdd443c46caf6536758fbe589'; // Replace with your TMDb API Key
    private $baseUrl = 'https://api.themoviedb.org/3/';

    public function run()
    {
        $movies = $this->fetchPopularMovies(50);

        foreach ($movies as $movie) {
            DB::table('movies')->insert($this->formatMovie($movie));
        }
    }

    private function fetchPopularMovies($count)
    {
        $response = Http::get($this->baseUrl . 'movie/popular', [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1,
        ]);

        return $response->json()['results'] ?? [];
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
