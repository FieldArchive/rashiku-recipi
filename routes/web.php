<?php

use App\Support\RashikuContent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/articles/{slug}', function (string $slug) {
    $article = Arr::get(RashikuContent::articles(), $slug);
    abort_unless($article, 404);

    return view('article', [
        'title' => $article['title'],
        'html' => $article['html'],
    ]);
})->name('articles.show');

Route::get('/movies/{slug}', function (string $slug) {
    $movie = Arr::get(RashikuContent::movies(), $slug);
    abort_unless($movie, 404);

    return view('article', [
        'title' => $movie['title'],
        'html' => $movie['html'],
        'backUrl' => url('/'),
        'backLabel' => '← トップにもどる',
    ]);
})->name('movies.show');

Route::get('/documentaries/{slug}', function (string $slug) {
    $documentary = Arr::get(RashikuContent::documentaries(), $slug);
    abort_unless($documentary, 404);

    return view('article', [
        'title' => $documentary['title'],
        'html' => $documentary['html'],
        'backUrl' => url('/'),
        'backLabel' => '← トップにもどる',
    ]);
})->name('documentaries.show');
