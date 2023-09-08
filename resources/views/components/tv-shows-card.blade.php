<div class="mt-8">
    <a href="{{ route('tv.show', $tvShow['id']) }}">
        <img src="{{ $tvShow['poster_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('tv.show', $tvShow['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $tvShow['name'] }}</a>
        <div class="text-gray-400 flex items-center text-sm mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 text-orange-500 fill-current">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
            <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
            <span class="mx-2">|</span>
            <span>{{ $tvShow['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">
            {{ $tvShow['genres'] }}
        </div>
    </div>
</div>
