<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MovieRepository
{
    public function store($movie): Movie
    {
        $titleToLower = strtolower($movie['title']);
        $replaceWithDash = str_replace([' ', '.'], '-', $titleToLower);
        $generatePath = Str::slug($replaceWithDash, '-');

        $createdMovie = Movie::updateOrCreate(['id' => $movie['id']], [
            'id' => $movie['id'],
            'title' => $movie['title'],
            'overview' => (!empty($movie['overview']) ? $movie['overview'] : "Geen informatie beschikbaar"),
            'poster_path' => $movie['poster_path'],
            'vote_average' => $movie['vote_average'],
            'release_date' => $movie['release_date'],
            'popularity' => $movie['popularity'],
            'original_language' => $movie['original_language'],
            'path' => $generatePath,
        ]);

        return $createdMovie;
    }

    public function getMovies($threeMonthsAgo, $page): LengthAwarePaginator
    {
        return Movie::whereBetween('release_date', [$threeMonthsAgo, now()])
            ->orderBy('popularity', 'DESC')
            ->paginate(20, ['*'], 'page', $page);
    }

    public function getPaginationDetails(LengthAwarePaginator $movies): array
    {
        return [
            'next_page_url' => basename($movies->nextPageUrl()),
            'path' => $movies->url($movies->currentPage()),
            'per_page' => $movies->perPage(),
            'prev_page_url' => basename($movies->previousPageUrl()),
            'to' => $movies->lastItem(),
            'total' => $movies->total(),
        ];
    }

    public function getByPathWithFavoriteStatus($path): Movie | null
    {
        $movie = Movie::where('path', $path)->firstOrFail();

        if (!$movie) {
            return null;
        }

        $isFavorite = Auth::user() ? Auth::user()->favoriteMovies->contains($movie) : false;

        $movie->setAttribute('is_favorite', $isFavorite);

        return $movie;
    }
}
