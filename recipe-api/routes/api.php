<?php
//use App\Http\Controllers\RecipeController
use Illuminate\Http\Request;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes

|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public routes
//Route::get('/recipes', [RecipeController::class, 'index']);
//Route::post('/recipes', [RecipeController::class, 'store']);
//
Route::resource('recipes', RecipeController::class);
Route::get('/recipes/search/{name}', [RecipeController::class,'search']);
//protected routes
//Route::group(['middleware' => ['auth:sanctum']], function () {
//    //hier gaan beschermde routes zoals favoriete recepten
//});
//
//
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
