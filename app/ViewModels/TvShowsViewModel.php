<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvShowsViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv()
    {
        return $this->formatTvShows($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTvShows($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTvShows($tvs)
    {
        return collect($tvs)->map(function ($tvShow) {
            $formattedGenres = collect($tvShow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tvShow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $formattedGenres
            ])->only([
                'poster_path',
                'first_air_date',
                'name',
                'vote_average',
                'genres',
                'id',
                'genre_ids',
                'overview',
            ]);
        });
    }
}
