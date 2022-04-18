<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addListGamesController;
use App\Http\Controllers\searchGameController;
use App\Http\Controllers\dataGameController;
use App\Http\Controllers\HomeController;
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

Route::get('search', [searchGameController::class, "searchGame"])->middleware(['auth:sanctum'])->name('search.searchGames');

Route::get('search/special', [searchGameController::class, "specialSearch"])->middleware(['auth:sanctum'])->name('search.specialSearch');

Route::get('data/game/{id}', [dataGameController::class, "dataGame"])->middleware(['auth:sanctum'])->name('data.dataGames');