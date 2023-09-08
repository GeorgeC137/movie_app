@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        {{-- Start of popular actors  --}}
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider font-semibold text-orange-500 text-lg">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4">
                @foreach ($popularActors as $popularActor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $popularActor['id']) }}">
                            <img src="{{ $popularActor['profile_path'] }}" alt="profile pic" class="hover;opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $popularActor['id']) }}" class="text-lg hover:text-gray-300">{{ $popularActor['name'] }}</a>
                            <div class="text-sm text-gray-400 truncate">{{ $popularActor['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- End of popular actors  --}}

        <div class="page-load-status">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner text-4xl my-8">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>

        {{-- Start of pagination
        <div class="flex justify-between mt-16">
            @if ($previousPage)
                <a href="/actors/page/{{ $previousPage }}">Previous</a>
            @else
                <div></div>
            @endif

            @if ($nextPage)
                <a href="/actors/page/{{ $nextPage }}">Next</a>
            @else
                <div></div>
            @endif
        </div>
        End of pagination  --}}
    </div>
@endsection

{{-- Start of Infinitescroll(replaced pagination) --}}
@section('scripts')
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

<script>
    let elem = document.querySelector('.grid');
    let infScroll = new InfiniteScroll( elem, {
    // options
    path: '/actors/page/@{{#}}',
    append: '.actor',
    status: '.page-load-status'
    // history: false,
    });
</script>
@endsection
{{-- End of infinite scroll  --}}
