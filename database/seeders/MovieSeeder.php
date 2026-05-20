<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temporarily use the old catalog function to get data
        $catalog = $this->movieCatalog();

        foreach ($catalog as $movieData) {
            // Clean asset paths to store relative paths in DB
            $movieData['image'] = $this->cleanAssetPath($movieData['image']);
            $movieData['cast'] = array_map(function ($castMember) {
                $castMember['image'] = $this->cleanAssetPath($castMember['image']);

                return $castMember;
            }, $movieData['cast']);
            $movieData['gallery'] = array_map(fn ($galleryImage) => $this->cleanAssetPath($galleryImage), $movieData['gallery']);

            Movie::create($movieData);
        }
    }

    /**
     * Helper to convert full asset URLs to relative paths.
     */
    private function cleanAssetPath(string $url): string
    {
        return ltrim(parse_url($url, PHP_URL_PATH) ?: '', '/');
    }

    /**
     * A temporary copy of the original movie catalog function.
     */
    private function movieCatalog(): array
    {
        // NOTE: asset() calls are left here but will be cleaned by cleanAssetPath()
        return [
            'real-steel' => [
                'id' => 'real-steel',
                'title' => 'Real Steel',
                'image' => asset('images/movies/first1.jpg'),
                'year' => '2011',
                'duration' => '127m',
                'genre' => 'Sci-Fi, Action, Drama',
                'rating' => '4.5',
                'description' => 'A former boxer rebuilds his life by training a discarded robot into an underground fighting champion.',
                'cast' => [
                    ['name' => 'Hugh Jackman', 'role' => 'Charlie Kenton', 'image' => asset('images/movies/first1.jpg')],
                    ['name' => 'Dakota Goyo', 'role' => 'Max Kenton', 'image' => asset('images/movies/first2.jpg')],
                    ['name' => 'Evangeline Lilly', 'role' => 'Bailey Tallet', 'image' => asset('images/movies/first3.jpg')],
                ],
                'reviews' => [
                    ['author' => 'Miles', 'comment' => 'The robot fights were fun and the father-son story was easy to connect with.'],
                    ['author' => 'Ayen', 'comment' => 'Good action scenes and a nice emotional ending.'],
                ],
                'gallery' => [
                    asset('images/movies/first1.jpg'),
                    asset('images/movies/first2.jpg'),
                    asset('images/movies/first3.jpg'),
                    asset('images/movies/first4.jpg'),
                ],
            ],
            'pacific-rim' => [
                'id' => 'pacific-rim',
                'title' => 'Pacific Rim',
                'image' => asset('images/movies/first2.jpg'),
                'year' => '2013',
                'duration' => '131m',
                'genre' => 'Action, Adventure, Sci-Fi',
                'rating' => '4.3',
                'description' => 'Massive robots are humanity\'s final defense against giant sea monsters rising from another dimension.',
                'cast' => [
                    ['name' => 'Charlie Hunnam', 'role' => 'Raleigh Becket', 'image' => asset('images/movies/first2.jpg')],
                    ['name' => 'Rinko Kikuchi', 'role' => 'Mako Mori', 'image' => asset('images/movies/first3.jpg')],
                    ['name' => 'Idris Elba', 'role' => 'Stacker Pentecost', 'image' => asset('images/movies/first5.jpg')],
                ],
                'reviews' => [
                    ['author' => 'Ken', 'comment' => 'Huge scale, great action, and the Jaegers still look awesome.'],
                    ['author' => 'Jade', 'comment' => 'A really entertaining sci-fi movie with strong visuals.'],
                ],
                'gallery' => [
                    asset('images/movies/first2.jpg'),
                    asset('images/movies/first5.jpg'),
                    asset('images/movies/first6.jpg'),
                    asset('images/movies/first1.jpg'),
                ],
            ],
            'maze-runner' => [
                'id' => 'maze-runner',
                'title' => 'The Maze Runner',
                'image' => asset('images/movies/first3.jpg'),
                'year' => '2014',
                'duration' => '113m',
                'genre' => 'Mystery, Thriller, Sci-Fi',
                'rating' => '4.1',
                'description' => 'A teenager wakes up in a strange maze community and joins others searching for the way out.',
                'cast' => [
                    ['name' => 'Dylan O\'Brien', 'role' => 'Thomas', 'image' => asset('images/movies/first3.jpg')],
                    ['name' => 'Kaya Scodelario', 'role' => 'Teresa', 'image' => asset('images/movies/first4.jpg')],
                    ['name' => 'Thomas Brodie-Sangster', 'role' => 'Newt', 'image' => asset('images/movies/first2.jpg')],
                ],
                'reviews' => [
                    ['author' => 'Sam', 'comment' => 'The mystery kept me watching until the end.'],
                    ['author' => 'Chris', 'comment' => 'Fast-paced and easy to binge if you like survival thrillers.'],
                ],
                'gallery' => [
                    asset('images/movies/first3.jpg'),
                    asset('images/movies/first4.jpg'),
                    asset('images/movies/first2.jpg'),
                    asset('images/movies/first5.jpg'),
                ],
            ],
            'wolf-of-wall-street' => [
                'id' => 'wolf-of-wall-street',
                'title' => 'The Wolf of Wall Street',
                'image' => asset('images/movies/first4.jpg'),
                'year' => '2013',
                'duration' => '180m',
                'genre' => 'Biography, Comedy, Crime',
                'rating' => '4.4',
                'description' => 'Jordan Belfort rises to wealth and excess through stock market fraud and relentless ambition.',
                'cast' => [
                    ['name' => 'Leonardo DiCaprio', 'role' => 'Jordan Belfort', 'image' => asset('images/movies/first4.jpg')],
                    ['name' => 'Margot Robbie', 'role' => 'Naomi Lapaglia', 'image' => asset('images/movies/first1.jpg')],
                    ['name' => 'Jonah Hill', 'role' => 'Donnie Azoff', 'image' => asset('images/movies/first6.jpg')],
                ],
                'reviews' => [
                    ['author' => 'Paolo', 'comment' => 'Wild energy from start to finish and very memorable performances.'],
                    ['author' => 'Mira', 'comment' => 'Long movie but never boring for me.'],
                ],
                'gallery' => [
                    asset('images/movies/first4.jpg'),
                    asset('images/movies/first1.jpg'),
                    asset('images/movies/first6.jpg'),
                    asset('images/movies/first3.jpg'),
                ],
            ],
            'i-am-legend' => [
                'id' => 'i-am-legend',
                'title' => 'I Am Legend',
                'image' => asset('images/movies/first5.jpg'),
                'year' => '2007',
                'duration' => '101m',
                'genre' => 'Drama, Horror, Sci-Fi',
                'rating' => '4.2',
                'description' => 'The last known survivor in New York searches for a cure while hiding from infected mutants.',
                'cast' => [
                    ['name' => 'Will Smith', 'role' => 'Robert Neville', 'image' => asset('images/movies/first5.jpg')],
                    ['name' => 'Alice Braga', 'role' => 'Anna', 'image' => asset('images/movies/first2.jpg')],
                    ['name' => 'Charlie Tahan', 'role' => 'Ethan', 'image' => asset('images/movies/first1.jpg')],
                ],
                'reviews' => [
                    ['author' => 'Noel', 'comment' => 'Still one of the most memorable post-apocalyptic movies for me.'],
                    ['author' => 'Grace', 'comment' => 'The lonely atmosphere was really effective.'],
                ],
                'gallery' => [
                    asset('images/movies/first5.jpg'),
                    asset('images/movies/first2.jpg'),
                    asset('images/movies/first1.jpg'),
                    asset('images/movies/first6.jpg'),
                ],
            ],
            'fast-and-furious' => [
                'id' => 'fast-and-furious',
                'title' => 'The Fast and the Furious',
                'image' => asset('images/movies/first6.jpg'),
                'year' => '2001',
                'duration' => '106m',
                'genre' => 'Action, Crime, Thriller',
                'rating' => '4.0',
                'description' => 'An undercover cop enters the street-racing world and gets pulled into a dangerous new family.',
                'cast' => [
                    ['name' => 'Paul Walker', 'role' => 'Brian O\'Conner', 'image' => asset('images/movies/first6.jpg')],
                    ['name' => 'Vin Diesel', 'role' => 'Dominic Toretto', 'image' => asset('images/movies/first5.jpg')],
                    ['name' => 'Michelle Rodriguez', 'role' => 'Letty Ortiz', 'image' => asset('images/movies/first4.jpg')],
                ],
                'reviews' => [
                    ['author' => 'Bry', 'comment' => 'Classic street racing movie with a lot of style.'],
                    ['author' => 'Anne', 'comment' => 'Simple story, but the chemistry and cars still work.'],
                ],
                'gallery' => [
                    asset('images/movies/first6.jpg'),
                    asset('images/movies/first5.jpg'),
                    asset('images/movies/first4.jpg'),
                    asset('images/movies/first2.jpg'),
                ],
            ],
        ];
    }
}