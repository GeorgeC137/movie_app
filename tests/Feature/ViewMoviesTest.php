<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenreArray()
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        // $response->assertSee('Fake Genre');
    }

    public function test_the_search_drop_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movies?query=barbie'=> $this->fakeSearchedMovie()
        ]);

        Livewire::test('search-drop')
            ->assertDontSee('Barbie')
            ->set('search', 'Barbie')
            ->assertSee('Barbie');

    }

    private function fakeSearchedMovie()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/fm6KqXpk3M2HVveHwCrBSSBaO0V.jpg",
                    "genre_ids" => [
                        0 => 18,
                        1 => 36
                    ],
                    "id" => 872585,
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "overview" => "The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.",
                    "popularity" => 756.555,
                    "poster_path" => "/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg",
                    "release_date" => "2023-07-19",
                    "title" => "Barbie",
                    "video" => false,
                    "vote_average" => 8.3,
                    "vote_count" => 1727

                ],
            ]
        ], 200);
    }

    public function test_show_movie_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*'=> $this->fakeSingleMovie()
        ]);

        $response = $this->get(route('movies.show', 813477));

        $response->assertSuccessful();
        $response->assertSee('Fake Shin Kamen Rider Movie');
        $response->assertSee('Shin Kamen Rider');
        $response->assertSee('Sosuke Ikematsu'); // cast
        $response->assertSee('Takayuki Takeya'); // crew
    }

    private function fakeSingleMovie()
    {
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/iJ0UZaC7XW7BUpRQ7OLPZSms8Ou.jpg",
            "budget" => 0,
            "homepage" => "",
            "id" => 813477,
            "imdb_id" => "tt14379088",
            "original_language" => "ja",
            "original_title" => "シン・仮面ライダー",
            "overview" => "A man forced to bear power and stripped of humanity. A woman skeptical of happiness. Takeshi Hongo, an Augmentation made by SHOCKER, and Ruriko Midorikawa, a re ",
            "popularity" => 920.819,
            "poster_path" => "/9dTO2RygcDT0cQkawABw4QkDegN.jpg",
            "release_date" => "2023-03-17",
            "revenue" => 14768529,
            "runtime" => 121,
            "status" => "Released",
            "tagline" => "Things that change. Things that don't.  ...and things that I wouldn't want to change.",
            "title" => "Fake Shin Kamen Rider Movie",
            "video" => false,
            "vote_average" => 7.512,
            "vote_count" => 123,
            "belongs_to_collection" => [
                [
                    "id" => 1162276,
                    "name" => "Shin Japan Heroes Universe",
                    "poster_path" => "/ePN8kmV3htUA7VVkG4AsjqFXbEr.jpg",
                    "backdrop_path" => null
                ]
            ],
            "genres" => [
                [
                    "id" => 28,
                    "name" => "Action"
                ]
            ],
            "production_companies" => [
                [
                    "id" => 4145,
                    "logo_path" => "/aEiJyMKr2CxrAJiIdtN70wXqn.png",
                    "name" => "khara",
                    "origin_country" => "JP"
                ]
            ],
            "production_countries" => [
                [
                    "iso_3166_1" => "JP",
                    "name" => "Japan"
                ]
            ],
            "spoken_languages" => [
                [
                    "english_name" => "Japanese",
                    "iso_639_1" => "ja",
                    "name" => "日本語"
                ]
            ],
            "credits" => [
                "cast" => [
                    [
                        "adult" => false,
                        "gender" => 2,
                        "id" => 1116510,
                        "known_for_department" => "Acting",
                        "name" => "Sosuke Ikematsu",
                        "original_name" => "Sosuke Ikematsu",
                        "popularity" => 5.355,
                        "profile_path" => "/mNhgUAKfHdKQXhbhbAhKcRUHy30.jpg",
                        "cast_id" => 4,
                        "character" => "Takeshi Hongo / Kamen Rider",
                        "credit_id" => "6155b6298741c40029d58abe",
                        "order" => 0
                    ]
                ],
                "crew" => [
                    [
                        "adult" => false,
                        "gender" => 0,
                        "id" => 9667,
                        "known_for_department" => "Visual Effects",
                        "name" => "Takayuki Takeya",
                        "original_name" => "Takayuki Takeya",
                        "popularity" => 0.6,
                        "profile_path" => null,
                        "credit_id" => "64282163960cde0103a49729",
                        "department" => "Visual Effects",
                        "job" => "Modeling"
                    ]
                ]
            ],
            "videos" => [
                "results" =>  [
                    [
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "name" => "Shin Kamenrider additional trailer(English sub)",
                        "key" => "ZriPV8lhHsE",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                        "official" => false,
                        "published_at" => "2023-03-23T14:52:29.000Z",
                        "id" => "6498afcd03bf84013c02d925"
                    ]
                ]
            ],
            "images" => [
                "backdrops" =>[
                    [
                        "aspect_ratio" => 1.778,
                        "height" => 2109,
                        "iso_639_1" => null,
                        "file_path" => "/iJ0UZaC7XW7BUpRQ7OLPZSms8Ou.jpg",
                        "vote_average" => 5.456,
                        "vote_count" => 7,
                        "width" => 3749
                    ]
                ],
                "logos" => [
                    [
                        "aspect_ratio" => 5.041,
                        "height" => 386,
                        "iso_639_1" => "ja",
                        "file_path" => "/bvv07jXPzryofeYmIQUVZFQT4HP.png",
                        "vote_average" => 0.0,
                        "vote_count" => 0,
                        "width" => 1946
                    ]
                ],
                "poster" => [
                    [
                        "aspect_ratio" => 0.667,
                        "height" => 1500,
                        "iso_639_1" => "en",
                        "file_path" => "/9dTO2RygcDT0cQkawABw4QkDegN.jpg",
                        "vote_average" => 5.522,
                        "vote_count" => 4,
                        "width" => 1000
                    ]
                ]
            ],
        ], 200);
    }

    private function fakePopularMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/fm6KqXpk3M2HVveHwCrBSSBaO0V.jpg",
                    "genre_ids" => [
                        0 => 18,
                        1 => 36
                    ],
                    "id" => 872585,
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "overview" => "The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.",
                    "popularity" => 756.555,
                    "poster_path" => "/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg",
                    "release_date" => "2023-07-19",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 8.3,
                    "vote_count" => 1727

                ],
            ]
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/fm6KqXpk3M2HVveHwCrBSSBaO0V.jpg",
                    "genre_ids" => [
                        0 => 18,
                        1 => 36
                    ],
                    "id" => 872585,
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "overview" => "The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.",
                    "popularity" => 756.555,
                    "poster_path" => "/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg",
                    "release_date" => "2023-07-19",
                    "title" => "Now Playing Fake Movie",
                    "video" => false,
                    "vote_average" => 8.3,
                    "vote_count" => 1727

                ],
            ]
        ], 200);
    }

    private function fakeGenreArray()
    {
        return Http::response([
            'genres' => [
                [
                    "id" => 28,
                    "name" => "Fake Genre"
                ],
            ]
        ], 200);
    }
}
