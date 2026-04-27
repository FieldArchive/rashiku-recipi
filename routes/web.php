<?php

use App\Support\RashikuContent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/recipes/{slug}', function (string $slug) {
    $recipe = Arr::get(RashikuContent::recipes(), $slug);
    abort_unless($recipe, 404);

    return view('recipe', [
        'title' => $recipe['title'],
        'summary' => $recipe['summary'],
        'body' => $recipe,
    ]);
})->name('recipes.show');

Route::get('/articles/{slug}', function (string $slug) {
    $article = Arr::get(RashikuContent::articles(), $slug);
    abort_unless($article, 404);

    return view('article', [
        'title' => $article['title'],
        'html' => $article['html'],
    ]);
})->name('articles.show');
