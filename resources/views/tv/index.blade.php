@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        {{-- Start of popular tv  --}}
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider font-semibold text-orange-500 text-lg">Popular Tv</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($popularTv as $tvShow)
                    <x-tv-shows-card :tvShow="$tvShow" />
                @endforeach
            </div>
        </div>
        {{-- End of popular movies  --}}

        {{-- Start of now plying movies  --}}
        <div class="top-rated-tv py-24">
            <h2 class="uppercase tracking-wider font-semibold text-orange-500 text-lg">Top Rated Tv</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($topRatedTv as $tvShow)
                    <x-tv-shows-card  :tvShow="$tvShow" />
                @endforeach
            </div>
        </div>
        {{-- End of now playing tv  --}}
    </div>
@endsection

