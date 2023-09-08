<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;


class ActorViewModel extends ViewModel
{
    public $actor;
    public $credits;
    public $social;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
                ? 'https://image.tmdb.org/t/p/w300/'.$this->actor['profile_path']
                : 'https://picsum.photos/300'
        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id'] : null,
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'tiktok' => $this->social['tiktok_id'] ? 'https://tiktok.com/'.$this->social['tiktok_id'] : null,
            'youtube' => $this->social['youtube_id'] ? 'https://youtube.com/'.$this->social['youtube_id'] : null
        ]);
    }

    public function knownForMovies()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->sortByDesc('popularity')->take(5)
            ->map(function ($movie) {
                if (isset($movie['title'])) {
                    $title = $movie['title'];
                } elseif (isset($movie['name'])) {
                    $title = $movie['name'];
                } else {
                    $title = 'Untitled';
                }

                return collect($movie)->merge([
                    'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w92'.$movie['poster_path'] : 'https://picsum.photos/185',
                    'title' => $title,
                    'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
                ]);
            });

        // $castMovies = collect($this->credits['cast'])->where('media_type', 'movie')->sortByDesc('popularity')->take(5);

        // return $castMovies->map(function ($movie) {
        //     return collect($movie)->merge([
        //         'gal' => 'okay'
        //     ]);
        // })->dump();
    }

    public function credits()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function ($movie) {

            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = 'null';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : ''
            ]);
        })->sortByDesc('release_date');
    }
}
