<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginateApiController;
use App\Http\Controllers\searchGameController;
use App\Http\Controllers\dataGameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\listController;
use App\Http\Controllers\CarruselController;
use App\Http\Controllers\UserController;
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
    if (Auth::user()) {
        return redirect()->route("home.index");
    }
    return view('components/welcome');
});

Auth::routes();

Route::resource('home', HomeController::class)->middleware(['auth:sanctum']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('list', addListGamesController::class)->middleware(['auth:sanctum']);

Route::get('/carrusel/{category}', [CarruselController::class, 'load'])->middleware(['auth:sanctum'])->name('carrusel.load');

Route::get('/list', [listController::class, 'index'])->middleware(['auth:sanctum'])->name('list.index');

Route::get('/list/{name}', [listController::class, 'load'])->middleware(['auth:sanctum'])->name('list.load');

Route::delete('/list', [listController::class, 'delete'])->middleware(['auth:sanctum'])->name('list.delete');

Route::get('search', [searchGameController::class, "searchGame"])->middleware(['auth:sanctum'])->name('search.searchGames');

Route::get('search/special', [searchGameController::class, "specialSearch"])->middleware(['auth:sanctum'])->name('search.specialSearch');

Route::get('search/list', [searchGameController::class, "searchList"])->middleware(['auth:sanctum'])->name('search.searchList');

Route::get('paginate', [PaginateApiController::class, "paginate"])->middleware(['auth:sanctum'])->name('paginate.api');

Route::get('data/game/{id}', [dataGameController::class, "dataGame"])->middleware(['auth:sanctum'])->name('data.dataGames');

//Route::resource('user', UserController::class)->only(["edit","update"])->middleware(['auth:sanctum','settingUser']);
Route::get('user/settings', [UserController::class,"showDataUser"])->middleware(['auth:sanctum'])->name("user.show");

Route::patch('user/update', [UserController::class,"update"])->middleware(['auth:sanctum'])->name("user.update");

//Route::get('user/settings?id={id}', [UserController::class,"edit"])->middleware(['auth:sanctum','settingUser'])->name("user.edit");