<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDrop extends Component
{
    public string $search = '';

    public function render()
    {
        $searchResults = [];

        if ($this->search) {
            $searchResults = Http::withToken(env('TMDB_TOKEN'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
                ->json()['results'];
        }

        // dump($searchResults);

        return view('livewire.search-drop', [
            'searchResults' => collect($searchResults)->take(6),
        ]);
    }
}
