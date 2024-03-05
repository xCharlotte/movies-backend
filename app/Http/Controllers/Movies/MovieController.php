<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Repositories\MovieRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $threeMonthsAgo = Carbon::now()->subMonths(2);

        $movies = $this->movieRepository->getMovies($threeMonthsAgo, $page);
        $pagination = $this->movieRepository->getPaginationDetails($movies);

        return response()->json([
            'status' => 'success',
            'count' => count($movies),
            'data' => $movies,
            'pagination' => $pagination,
        ]);
    }

    public function show($path)
    {
        $movie = $this->movieRepository->getByPathWithFavoriteStatus($path);

        if (!$movie) {
            return response()->json([
                'status' => 'error',
                'message' => 'Movie not found.',
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $movie,
        ]);
    }

    public function showFavorite()
    {
        $user = auth()->user();

        $favoriteMovies = $user->favoriteMovies;

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function storeFavorite(Request $request)
    {
        $user = auth()->user();

        $movieId = $request->input('movie_id');

        if (!$user->favoriteMovies()->where('movie_id', $movieId)->exists()) {
            $user->favoriteMovies()->syncWithoutDetaching($movieId);

            return response()->json(['message' => 'Film is toegevoegd aan je favorieten']);
        }

        return response()->json(['message' => 'Film bestaat al als favoriet van de user']);
    }

    public function removeFavorite($movie_id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Gebruiker niet geauthenticeerd'], 401);
        }
    
        $user->favoriteMovies()->detach($movie_id);
    }
}