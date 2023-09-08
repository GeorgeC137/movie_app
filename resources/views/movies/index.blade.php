@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        {{-- Start of popular movies  --}}
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider font-semibold text-orange-500 text-lg">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($popularMovies as $movie)
                    <x-movies-card :movie="$movie" />
                @endforeach
            </div>
        </div>
        {{-- End of popular movies  --}}

        {{-- Start of now plying movies  --}}
        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider font-semibold text-orange-500 text-lg">Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($nowPlayingMovies as $movie)
                    <x-movies-card  :movie="$movie" />
                @endforeach
            </div>
        </div>
        {{-- End of now playing movies  --}}
    </div>
@endsection
