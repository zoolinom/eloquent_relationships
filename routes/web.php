<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

Route::get('/videos/all', function () {
    $videos = App\Video::whereHasMorph(
        'watchable',
        ['App\Series', 'App\Collection']
    )->get();

    return response()->json($videos);
});

Route::get('/videos/series', function () {
    $videos = App\Video::whereHasMorph(
        'watchable',
        'App\Series'
    )->get();

    return response()->json($videos);
});

Route::get('/videos/collection', function () {
    $videos = App\Video::whereHasMorph(
        'watchable',
        'App\Collection'
    )->get();

    return response()->json($videos);
});

Route::get('/videos/{name}', function (Request $request) {
    $videos = App\Video::whereHasMorph(
        'watchable',
        ['App\Series', 'App\Collection'],
        function(Builder $query) use ($request) {
            $query->where('title', 'like', $request->name . '%');
        }
    )->get();

    return response()->json($videos);
});

Route::get('/series/{series}/add/video', function (App\Series $series) {
    $video = new App\Video([
        'title' => 'Some series video title',
        'description' => 'Some series video description',
        'url' => 'Some url'
    ]);
    $series->videos()->save($video);

    return response()->json($video);
});

Route::get('/collection/{collection}/add/video', function (App\Collection $collection) {
    $video = new App\Video([
        'title' => 'Some collection video title',
        'description' => 'Some collection video description',
        'url' => 'Some url'
    ]);
    $collection->videos()->save($video);

    return response()->json($video);
});

Route::get('/videos/{video}/all', function (App\Video $video) {
    $watchables = $video->watchable;

    return response()->json($watchables);
});
