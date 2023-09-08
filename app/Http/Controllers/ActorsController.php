<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('actors.index', $viewModel);
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
        $actor = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/person/'.$id)
            ->json();

        $social = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
            ->json();

        $credits = Http::withToken(env('TMDB_TOKEN'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
            ->json();

        // dump($credits);
        // dump($social);

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', $viewModel);
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
