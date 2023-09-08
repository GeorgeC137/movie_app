<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvShow;

    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }

    public function tvShow()
    {
        return collect($this->tvShow)->merge([
            'first_air_date' => Carbon::parse($this->tvShow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvShow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvShow['credits']['crew'])->take(2),
            'cast' => collect($this->tvShow['credits']['cast'])->take(5),
            'images-backdrops' => collect($this->tvShow['images']['backdrops'])->take(9),
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->tvShow['poster_path'],
            'vote_average' => $this->tvShow['vote_average'] * 10 . '%'
        ]);
    }
}
