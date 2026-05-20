<?php

use App\Http\Controllers\ProfileController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;

if (! function_exists('profileSocialLinks')) {
    function profileSocialLinks(\App\Models\User $user): array
    {
        $handle = $user->social_handle
            ?: strtolower(preg_replace('/[^a-z0-9]+/', '', $user->name))
            ?: 'moviesquareuser';

        return [
            [
                'label' => 'Facebook',
                'url' => 'https://facebook.com/' . $handle,
            ],
            [
                'label' => 'Instagram',
                'url' => 'https://instagram.com/' . $handle,
            ],
            [
                'label' => 'TikTok',
                'url' => 'https://tiktok.com/@' . $handle,
            ],
        ];
    }
}

if (! function_exists('watchedMovieData')) {
    function watchedMovieData(\App\Models\User $user): array
    {
        $allMovieIds = Movie::pluck('id');
        $watchedIds = collect($user->watched_movies ?? [])
            ->filter(fn ($movieId) => $allMovieIds->contains($movieId))
            ->values();

        $watchedMovies = $watchedIds->isNotEmpty()
            ? Movie::findMany($watchedIds)
            : Movie::take(6)->get();

        if ($watchedMovies->isEmpty()) {
            $watchedMovies = Movie::take(6)->get();
        }

        $genreCounts = collect($watchedMovies)
            ->flatMap(fn ($movie) => array_map('trim', explode(',', $movie['genre'])))
            ->countBy()
            ->sortDesc();

        $maxCount = max(1, (int) $genreCounts->max());

        $genreBars = $genreCounts
            ->take(10)
            ->map(fn ($count, $genre) => [
                'name' => $genre,
                'width' => round(($count / $maxCount) * 100) . '%',
            ])
            ->values()
            ->all();

        $userReviews = collect($watchedMovies)
            ->map(function (Movie $movie, $index) use ($user) {
                $review = $movie->reviews[$index % max(1, count($movie->reviews))]['comment'] ?? 'Great watch.';

                return [
                    'movie_id' => $movie->id,
                    'movie_title' => $movie->title,
                    'movie_image' => $movie->image,
                    'rating' => $movie->rating,
                    'comment' => $user->name . ': ' . $review,
                ];
            })
            ->all();

        return [
            'watchedMovies' => $watchedMovies->all(),
            'genreBars' => $genreBars,
            'recommendedMovies' => Movie::take(6)->get()->all(),
            'userReviews' => $userReviews,
            'socialLinks' => profileSocialLinks($user),
        ];
    }
}

if (! function_exists('favoriteMovieData')) {
    function favoriteMovieData(\App\Models\User $user): array
    {
        $allMovieIds = Movie::pluck('id');
        $favoriteIds = collect($user->favorite_movies ?? [])
            ->filter(fn ($movieId) => $allMovieIds->contains($movieId))
            ->values();

        return [
            'favoriteMovies' => Movie::findMany($favoriteIds)->all(),
        ];
    }
}

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::view('/dashboard', 'ms.dashboard')->name('dashboard');

    Route::get('/movies', function () {
        $movies = Movie::all();
        $moviesById = $movies->keyBy('id');

        $heroMovies = Movie::findMany(['pacific-rim', 'real-steel', 'i-am-legend']);
        $heroItems = $heroMovies->map(fn (Movie $movie) => [
            'id' => $movie->id,
            'title' => $movie->title,
            'image' => $movie->image,
            'year' => $movie->year,
            'meta' => $movie->genre,
            'description' => $movie->description,
            'detail_url' => route('movies.show', $movie->id),
            'watch_url' => route('movies.watch', $movie->id),
        ])->all();

        $categories = [
            [
                'id' => 'all',
                'label' => 'All',
                'image' => $moviesById->get('real-steel')?->image,
                'movie_ids' => $movies->pluck('id')->all(),
            ],
            [
                'id' => 'hollywood',
                'label' => 'Hollywood',
                'image' => $moviesById->get('wolf-of-wall-street')?->image,
                'movie_ids' => ['real-steel', 'wolf-of-wall-street', 'fast-and-furious'],
            ],
            [
                'id' => 'filipino',
                'label' => 'Filipino',
                'image' => $moviesById->get('maze-runner')?->image,
                'movie_ids' => ['maze-runner', 'i-am-legend'],
            ],
            [
                'id' => 'english-dub',
                'label' => 'English Dub',
                'image' => $moviesById->get('pacific-rim')?->image,
                'movie_ids' => ['pacific-rim', 'real-steel', 'i-am-legend'],
            ],
            [
                'id' => 'horror',
                'label' => 'Horror Movies',
                'image' => $moviesById->get('i-am-legend')?->image,
                'movie_ids' => ['i-am-legend', 'maze-runner'],
            ],
            [
                'id' => 'animation',
                'label' => 'Animation',
                'image' => $moviesById->get('fast-and-furious')?->image,
                'movie_ids' => ['fast-and-furious', 'real-steel'],
            ],
            [
                'id' => 'korean',
                'label' => 'Korean Movies',
                'image' => $moviesById->get('maze-runner')?->image,
                'movie_ids' => ['maze-runner', 'pacific-rim'],
            ],
        ];

        return view('ms.movies.index', [
            'heroItems' => $heroItems,
            'categories' => $categories,
            'movies' => $movies,
        ]);
    })->name('movies.index');

    Route::get('/movies/{id}/watch', function ($id) {
        $movie = Movie::findOrFail($id);
        $user = auth()->user();

        $watchedMovies = collect($user->watched_movies ?? [])
            ->reject(fn ($movieId) => $movieId === $movie->id)
            ->prepend($movie->id)
            ->take(6)
            ->values()
            ->all();

        $user->forceFill([
            'watched_movies' => $watchedMovies,
        ])->save();

        return view('ms.movies.watch', [
            'movie' => $movie,
        ]);
    })->name('movies.watch');

    Route::post('/movies/{id}/favorite', function ($id) {
        $user = auth()->user();

        if (! Movie::where('id', $id)->exists()) {
            return back();
        }

        if (! $user->has_paid) {
            return redirect()->route('payment')
                ->with('payment_notice', 'Favorites unlock after payment is active.');
        }

        $favorites = collect($user->favorite_movies ?? []);

        if ($favorites->contains($id)) {
            $favorites = $favorites->reject(fn ($movieId) => $movieId === $id)->values();
        } else {
            $favorites = $favorites->prepend($id)->unique()->take(18)->values();
        }

        $user->forceFill([
            'favorite_movies' => $favorites->all(),
        ])->save();

        return back();
    })->name('movies.favorite');

    Route::get('/movies/{id}', function ($id) {
        $movie = Movie::findOrFail($id);
        $user = auth()->user();

        return view('ms.movies.show', [
            'movie' => $movie,
            'movies' => Movie::all(),
            'isFavorite' => in_array($movie->id, $user->favorite_movies ?? []),
            'hasPaid' => (bool) $user->has_paid,
        ]);
    })->name('movies.show');

    Route::get('/me', function () {
        return view('ms.profile', watchedMovieData(auth()->user()));
    })->name('me');

    Route::get('/favorites', function () {
        return view('ms.favorites', array_merge(
            favoriteMovieData(auth()->user()),
            ['hasPaid' => (bool) auth()->user()->has_paid]
        ));
    })->name('favorites');

    Route::get('/me/reviews', function () {
        return view('ms.profile-reviews', watchedMovieData(auth()->user()));
    })->name('me.reviews');

    Route::get('/me/settings', [ProfileController::class, 'edit'])->name('me.settings');

    Route::get('/payment', function () {
        return view('ms.payment', [
            'hasPaid' => (bool) auth()->user()->has_paid,
            'favoriteCount' => count(auth()->user()->favorite_movies ?? []),
        ]);
    })->name('payment');

    Route::post('/payment/activate', function () {
        auth()->user()->forceFill([
            'has_paid' => true,
        ])->save();

        return redirect()->route('payment')->with('payment_success', 'Payment activated. Favorites are now unlocked.');
    })->name('payment.activate');
});
