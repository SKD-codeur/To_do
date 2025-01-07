<?php

use App\Http\Controllers\Taches\TacheController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






// Route Login et Register

Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Gestion des route Utilisateurs
    Route::get('logout',[UserController::class,'logout']);
    Route::get('list/user',[UserController::class,'listUser']);

    // Gestion des Routes Taches
    Route::post('store/tache',[TacheController::class,'storeTache']);
    Route::get('liste/tache',[TacheController::class,'listTache']);
    Route::put('edit/tache/{id}',[TacheController::class,'editTache']);
    Route::delete('delete/tache/{id}',[TacheController::class,'deleteTache']);

});








