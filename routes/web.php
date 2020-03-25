<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $user = App\User::first();

    $post = $user->posts()->create([
        'title' => 'foobar',
        'body' => 'lorem ipsum'
    ]);

    $post->tags()->attach(1);

    return view('welcome');
});

Route::get('/tag/{tag}/posts', function (App\Tag $tag) {
    $posts = $tag->posts;

    return response()->json($posts);
});

Route::get('/post/{post}/tags', function (App\Post $post) {
    $tags = $post->tags;

    return response()->json($tags);
});

Route::get('/posts', function () {
    $posts = App\Post::with('tags')->get();

    // dd($posts);
    $tagsCount = $posts->map(function ($item, $key) {
        $tagNames = $item->tags->pluck('name')->all();
        return [$item->id => $tagNames];
    });

    return response()->json($tagsCount);
});

Route::get('/posts/affiliation/{affiliation}', function (App\Affiliation $affiliation) {
    $posts = $affiliation->posts;

    return response()->json($posts);
});

Route::get('/posts/affiliation/{affiliation}/tags', function (App\Affiliation $affiliation) {
    $posts = $affiliation->posts()->with('tags')->get();

    $tags = $posts->map(function ($item) {
        return [$item->id => $item->tags];
    });

    return response()->json($tags);
});

