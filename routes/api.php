<?php

use App\Http\Controllers\API\ApiFallbackController;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\AuthorAPIController;
use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\API\CountryAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\PublisherAPIController;
use App\Http\Controllers\API\GenreAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register',[AuthAPIController::class,'register']);
Route::post('/login', [AuthAPIController::class, 'login']);

// Authentication required API Routes (Auth-Sanctum Middleware)
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/authors", [AuthorAPIController::class, 'index']);
    Route::get("/authors/{id}", [AuthorAPIController::class, 'show']);
    Route::post('/authors', [AuthorAPIController::class, 'store']);
    Route::patch('/authors/{id}', [AuthorAPIController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorAPIController::class, 'destroy']);

    Route::get("/genres", [GenreAPIController::class, 'index']);
    Route::get("/genres/{id}", [GenreAPIController::class, 'show']);
    Route::post('/genres', [GenreAPIController::class, 'store']);
    Route::patch('/genres/{id}', [GenreAPIController::class, 'update']);
    Route::delete('/genres/{id}', [GenreAPIController::class, 'destroy']);

    Route::get("/books", [BookAPIController::class, 'index']);
    Route::get("/books/{id}", [BookAPIController::class, 'show']);
    Route::post('/books', [BookAPIController::class, 'store']);
    Route::patch('/books/{id}', [BookAPIController::class, 'update']);
    Route::delete('/books/{id}', [BookAPIController::class, 'destroy']);

    Route::post('/logout', [AuthAPIController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', UserAPIController::class);
Route::resource('publishers', PublisherAPIController::class);
Route::Resource('countries', CountryAPIController::class);


Route::fallback([ApiFallbackController::class, 'error']);
