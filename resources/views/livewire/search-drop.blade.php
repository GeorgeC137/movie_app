<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input
        wire:model.lazy="search"
        type="text"
        class="rounded-full bg-gray-800 px-4 pl-8 w-64 text-sm py-1"
        placeholder="Search..."
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-4 mt-2 ml-2 fill-current text-gray-500">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if ($this->search)
        <div
            class="z-50 absolute text-sm bg-gray-800 rounded w-64 mt-4"
            x-show.transition.opacity="isOpen"
            {{-- x-transition:enter="transition ease-out duration-300" --}}
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b bg-gray-700">
                            <a
                                href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-gray-700 py-3 px-3 flex items-center"
                                @if($loop->last) @keydown.tab="isOpen = false" @endif
                             >
                                @if ($result['poster_path'])
                                    <img src="{{ asset('https://image.tmdb.org/t/p/w92/'.$result['poster_path']) }}" alt="poster" class="w-8">
                                @else
                                    <img src="{{ asset('images/truegrit.jpg') }}" alt="placeholder" class="w-8">
                                @endif
                                <span class="ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="px-3 py-3">No results for "{{ $search }}"</p>
            @endif
        </div>
    @endif
</div>
