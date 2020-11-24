<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tag;
use Faker\Factory;

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
    return redirect()->route('posts.index');
});
Route::resources([
    'posts' =>  'PostController',
    'admin/tags' =>  'TagController',
]);
Route::resource('comments', 'CommentController');


// clash with posts resources
// Route::resource('admin/posts', 'AdminController')->names([
//     'index' => 'admin.post.index',
//     'create' => 'admin.post.create',
//     'show' => 'admin.post.show',
//     'edit' => 'admin.post.edit',
//     'destroy' => 'admin.post.destroy'
// ]);

// admin Controll
Route::get('/admin/posts1', 'AdminController@index')->name('admin.post.index');
Route::get('/admin/posts1/create', 'AdminController@create')->name('admin.post.create');
Route::get('/admin/posts1/{slug}', 'AdminController@show')->name('admin.post.show');
Route::get('/admin/posts1/{post}/edit', 'AdminController@edit')->name('admin.post.edit');
Route::post('/admin/posts1/store', 'AdminController@store')->name('admin.post.store');
Route::put('/admin/posts1/{post}', 'AdminController@update')->name('admin.post.update');
Route::delete('/admin/posts1/{id}','AdminController@destroy')->name('admin.post.destroy');
    



Route::get('posts/{slug}' , 'PostController@show')->name('posts.show1');
Route::put('posts/like/{id}', 'PostController@like')->name('posts.like');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{username}', 'ProfileController@show')->name('profile.show');
Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
Auth::routes();

Route::get('tags/{name}', 'PostController@serachPostsByTag')->name('search.by.name');

Route::get('test', function () {
   $tag = App\Models\Tag::find(6);

    // foreach ($tag->posts as $post) {
     dd($tag->posts[0]->title);
// }

   
});