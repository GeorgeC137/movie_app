@extends('layouts.app')

@section('content')
    {{-- Start of tv info  --}}
    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ $tvShow['poster_path'] }}" alt="poster" class=" w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tvShow['name'] }}</h2>
                <div class="text-gray-400 flex flex-wrap items-center text-sm mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 text-orange-500 fill-current">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                    <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvShow['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    {{-- <span class="mx-2">
                        {{ $tvShow['genres'] }}
                    </span> --}}
                </div>

                <p class="text-gray-300 mt-8">{{ $tvShow['overview'] }}</p>

                <div class="mt-12">
                    <div class="flex mt-4">
                        @foreach ($tvShow['created_by'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{isOpen: false}">
                    @if (count($tvShow['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                class="bg-orange-500 font-semibold text-gray-900 flex inline-flex items-center rounded py-4 px-5 hover:bg-orange-600 transition ease-in-out duration-150"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                    @endif

                    {{-- Start of Embeded youtube video modal --}}
                    <div
                        x-show.transition.opacity="isOpen"
                        style="background-color: rgba(0, 0, 0, -5);"
                        class="top-0 fixed left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    >
                        <div class="container mx-auto rounded-lg overflow-y-auto lg:px-32">
                            <div class="bg-gray-900 rounded">
                                <div class="flex pt-2 pr-4 justify-end">
                                    <button @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                </div>
                                <div class="px-8 py-8 modal-body">
                                    <div class="relative overflow-hidden responsive-container" style="padding-top: 56.25%;">
                                        <iframe width="560" height="315" src="https://youtube.com/embed/{{$tvShow['videos']['results'][0]['key']}}" frameborder="0" class="absolute top-0 w-full h-full left-0" style="border: 0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End of Embeded youtube video modal --}}
                </div>
            </div>
        </div>
    </div>
    {{-- End of tv info  --}}

    {{-- Start of tv cast --}}
    <div class="tv-cast border-b border-gray-800">
        <div class="container mx-auto py-16 px-4">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($tvShow['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            <img src="{{asset('https://image.tmdb.org/t/p/w300/'.$cast['profile_path'])}}" alt="cast" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- End of tv cast  --}}

    {{-- Start of images --}}
    <div class="tv-images" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto py-16 px-4">
            <h2 class="text-4xl font semi-bold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($tvShow['images-backdrops'] as $backdrop)
                    <div class="mt-8">
                        <a
                            href="#"
                            @click.prevent="
                                isOpen = true
                                image = '{{asset('https://image.tmdb.org/t/p/original/'.$backdrop['file_path'])}}'
                            "
                        >
                            <img src="{{asset('https://image.tmdb.org/t/p/w300/'.$backdrop['file_path'])}}" alt="truegrit" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Start of Image modal --}}
            <div
            x-show.transition.opacity="isOpen"
            style="background-color: rgba(0, 0, 0, -5);"
            class="top-0 fixed left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
            >
                <div class="container mx-auto rounded-lg overflow-y-auto lg:px-32">
                    <div class="bg-gray-900 rounded">
                        <div class="flex pt-2 pr-4 justify-end">
                            <button
                                @keydown.escape.window="isOpen = false"
                                @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300"
                            >&times;
                            </button>
                        </div>
                        <div class="px-8 py-8 modal-body">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Image modal --}}
        </div>
    </div>
    {{-- End of images  --}}
@endsection
