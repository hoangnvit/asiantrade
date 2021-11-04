<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CKEditorController;

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

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::any('(:any)/(:all?)', function () {
   return  redirect()->route('home');
});

require __DIR__ . '/auth.php';

//upload image for CKeditor
Route::post('ckeditor/image_upload',  [App\Http\Controllers\CKEditorController::class, 'upload'])->name('upload');


Route::get('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'updateprofile'])->middleware('auth')->name('updateprofile');

Route::get('/change_password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'index'])->middleware('auth')->name('changepassword_form');
Route::post('/change_password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'store'])->middleware('auth')->name('changepassword');
Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->middleware('auth')->name('admin');

// route for  user managed
Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->middleware('auth')->name('admin_users');
Route::get('/admin/users/user/{i}', [App\Http\Controllers\Admin\UserController::class, 'detail'])->middleware('auth')->name('detail');
Route::get('/admin/users/add', [App\Http\Controllers\Admin\UserController::class, 'user_create'])->middleware('auth')->name('user_add');
Route::post('/admin/users/add', [App\Http\Controllers\Admin\UserController::class, 'user_store'])->middleware('auth')->name('user_store');
Route::post('/admin/users/user/{i}', [App\Http\Controllers\Admin\UserController::class, 'user_edit'])->middleware('auth')->name('user_edit');
Route::get('/admin/users/delete/{i}', [App\Http\Controllers\Admin\UserController::class, 'user_delete'])->middleware('auth')->name('user_delete');


// Route for managing category
Route::get('/admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->middleware('auth')->name('admin_categories');
Route::get('/admin/categories/add', [App\Http\Controllers\Admin\CategoryController::class, 'category_create'])->middleware('auth')->name('category_add');
Route::post('/admin/categories/add', [App\Http\Controllers\Admin\CategoryController::class, 'category_store'])->middleware('auth')->name('category_store');
Route::get('/admin/categories/delete/{i}', [App\Http\Controllers\Admin\CategoryController::class, 'category_delete'])->middleware('auth')->name('category_delete');
Route::get('/admin/categories/category/{i}', [App\Http\Controllers\Admin\CategoryController::class, 'category_detail'])->middleware('auth')->name('category_detail');

Route::post('/admin/categories/category/{i}', [App\Http\Controllers\Admin\CategoryController::class, 'category_edit'])->middleware('auth')->name('category_edit');

// Route for managing post
Route::get('/admin/posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->middleware('auth')->name('admin_posts');
Route::get('/admin/posts/add', [App\Http\Controllers\Admin\PostController::class, 'post_create'])->middleware('auth')->name('post_add');
Route::post('/admin/posts/add', [App\Http\Controllers\Admin\PostController::class, 'post_store'])->middleware('auth')->name('post_store');
Route::get('/admin/posts/delete/{i}', [App\Http\Controllers\Admin\PostController::class, 'post_delete'])->middleware('auth')->name('post_delete');
Route::get('/admin/posts/post/{i}', [App\Http\Controllers\Admin\PostController::class, 'post_detail'])->middleware('auth')->name('post_detail');

Route::post('/admin/posts/post/{i}', [App\Http\Controllers\Admin\PostController::class, 'post_edit'])->middleware('auth')->name('post_edit');

//route for usage page
Route::get('/admin/usage/pie_chart', [App\Http\Controllers\Admin\StatisticController::class, 'category']);
Route::get('/admin/usage/pie_chart_delete', [App\Http\Controllers\Admin\StatisticController::class, 'reason']);
Route::get('/admin/usage/user_line_chart', [App\Http\Controllers\Admin\StatisticController::class, 'new_users']);
Route::get('/admin/usage/post_line_chart', [App\Http\Controllers\Admin\StatisticController::class, 'new_posts']);

Route::get('/admin/usage', [App\Http\Controllers\Admin\StatisticController::class, 'index'])->name('admin_statistic');



//route for homepage
Route::get('/{cat_id}/post', [App\Http\Controllers\User\PostController::class, 'postsbycategory'])->name('cat_posts');
Route::get('/post/detail/{post_id}', [App\Http\Controllers\User\PostController::class, 'detail'])->name('post');

Route::get('/post/create', [App\Http\Controllers\User\PostController::class, 'create'])->middleware('auth')->name('new_post');
Route::post('/post/create', [App\Http\Controllers\User\PostController::class, 'post_store'])->middleware('auth')->name('user_post_store');
Route::get('/post/user/{user_id}', [App\Http\Controllers\User\PostController::class, 'postsbyuser'])->middleware('auth')->name('user_posts');
Route::post('/post/user/{user_id}/{post_id}', [App\Http\Controllers\User\PostController::class, 'post_delete'])->middleware('auth')->name('user_posts_delete');
Route::get('/post/user/{user_id}/post/{post_id}', [App\Http\Controllers\User\PostController::class, 'post_detail'])->middleware('auth')->name('user_posts_detail');
Route::get('/post/user/{user_id}/post/{post_id}/delete', [App\Http\Controllers\User\PostController::class, 'post_delete_form'])->middleware('auth')->name('user_posts_delete_form');
Route::post('/post/user/{user_id}/post/{post_id}', [App\Http\Controllers\User\PostController::class, 'post_edit'])->middleware('auth')->name('user_post_edit');
Route::get('/post/search', [App\Http\Controllers\User\PostController::class, 'search'])->name('search');
Route::post('/post/search1', [App\Http\Controllers\User\PostController::class, 'search_post'])->name('search_result');

// Route for comment
Route::post('/comment/store', 'App\Http\Controllers\User\CommentController@store')->middleware('auth')->name('comment.add');
Route::post('/reply/store', 'App\Http\Controllers\User\CommentController@replyStore')->middleware('auth')->name('reply.add');
Route::post('/comment/edit', 'App\Http\Controllers\User\CommentController@comment_edit')->middleware('auth')->name('comment.edit');
Route::get('/comment/delete/{comment_id}', 'App\Http\Controllers\User\CommentController@comment_delete')->middleware('auth')->name('comment.delete');

// Route for like comment

Route::get('/comment/like/{comment_id}', 'App\Http\Controllers\User\LikeController@like')->name('comment.like');

// route get login stt 
Route::get('/user/stt', [App\Http\Controllers\User\SttController::class, 'get_stt'])->name('stt');

// route manage post by user
// Route::get('','App\Http\Controllers\User\PostController@comment_edit')->name('user_delete_post');

//route message
Route::get('/user/messages', [App\Http\Controllers\User\MessageController::class, 'index'])->middleware('auth')->name('message');
Route::get('/user/messages/inbox', [App\Http\Controllers\User\MessageController::class, 'inbox'])->middleware('auth')->name('message.inbox');
Route::get('/user/messages/outbox', [App\Http\Controllers\User\MessageController::class, 'outbox'])->middleware('auth')->name('message.outbox');
Route::get('/user/messages/{message_id}/detail', [App\Http\Controllers\User\MessageController::class, 'detail'])->middleware('auth')->name('message.detail');
Route::get('/user/messages/users', [App\Http\Controllers\User\MessageController::class, 'list_users'])->middleware('auth')->name('message.users');
Route::post('/user/messages/save', [App\Http\Controllers\User\MessageController::class, 'save_message'])->middleware('auth')->name('message.save');
Route::get('/user/messages/total', [App\Http\Controllers\User\MessageController::class, 'total_in_out'])->middleware('auth')->name('message.total');
Route::get('/user/messages/unread', [App\Http\Controllers\User\MessageController::class, 'unread'])->middleware('auth')->name('message.unread');
Route::get('/user/messages/{message_id}/un_display', [App\Http\Controllers\User\MessageController::class, 'un_display'])->middleware('auth')->name('message.un_display');
