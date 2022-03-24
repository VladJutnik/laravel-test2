<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [\App\Http\Controllers\BlogController::class, 'index']);
//дали название роуту ->name('getPostsByCategory') для тго что бы обьращаться к нему из html по имени и при желании поменять url он поменяется только тут а в файлах будет его имя!
Route::get('/category/{slug}', [\App\Http\Controllers\BlogController::class, 'getPostsByCategory'])->name('getPostsByCategory');
Route::get('/category/{slug_category}/{slug_post}', [\App\Http\Controllers\BlogController::class, 'getPosts'])->name('getPost');
Route::resource('users', UserController::class);

//Вы можете ограничить формат параметров вашего маршрута с помощью метода where() на экземпляре маршрута.
// Метод where() принимает название параметра и регулярное выражение, определяющее ограничения для параметра:
//->where('name', '[A-Za-z]+');
/*Route::get('user/{name}', function ($name) {
})->where('name', '[A-Za-z]+');
*/

//Это пример обезательного апараметра!!1
Route::get('/user/{id}', function ($id) {
    //return view('welcome');
    return "Вы ввели $id";
});
//Это пример не обезательного апараметра!!1
Route::get('user/{name?}', function ($name = null) {
    return $name;
});

