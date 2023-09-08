<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowsViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popularTv = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];

        // dd($popularMovies);

        $topRatedTv = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $genres = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        // dump($nowPlayingMovies);

        // dump($genreArray);

        $viewModel = new TvShowsViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tvShow = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
            ->json();

        // dump($movie);

        $viewModel = new TvShowViewModel($tvShow);

        return view('tv.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
