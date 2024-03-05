<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieService
{
    private $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->apiUrl = config('services.tmdb.api_url');
    }

    public function getNowPlayingMovies($language = 'nl', $page = 1): array
    {
        $url = $this->apiUrl . "movie/now_playing";
        $params = [
            'api_key' => $this->apiKey,
            'language' => $language,
            'page' => $page,
        ];

        $response = Http::get($url, $params);
        
        return $response->json()['results'];
    }

    public function getMovieGenres($language = 'nl')
    {
        $url = $this->apiUrl . "genre/movie/list";
        $params = [
            'api_key' => $this->apiKey,
            'language' => $language,
        ];

        $response = Http::get($url, $params);

        return $response->json();
    }
}