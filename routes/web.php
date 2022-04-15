<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addListGamesController;
use App\Http\Controllers\searchGameController;
use App\Http\Controllers\dataGameController;
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
    return view('components/welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('list', addListGamesController::class)->middleware(['auth:sanctum']);

Route::get('home/search', [searchGameController::class, "searchGame"])->middleware(['auth:sanctum'])->name('search.searchGames');

Route::get('data/game/{id}', [dataGameController::class, "dataGame"])->middleware(['auth:sanctum'])->name('data.dataGames');