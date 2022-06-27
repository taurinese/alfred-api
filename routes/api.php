<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\RentalFileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::post('/auth/login', [ApiTokenController::class, 'login']);
Route::post('/auth/register', [ApiTokenController::class, 'register']);
Route::get('/status', [StatusController::class, 'index']);
// Route::get('/fields', [FieldController::class, 'index']);
// Route::get('/files', [FileController::class, 'index']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/users')->group(function(){
        Route::delete('/delete/{id}', [UserController::class, 'destroy']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);

    });
    Route::prefix('/status')->group(function(){
        Route::get('/{id}', [StatusController::class, 'show']);
        Route::post('/create', [StatusController::class, 'store']);
        Route::put('/{id}', [StatusController::class, 'update']);
        Route::delete('/{id}', [StatusController::class, 'destroy']);
    });
    Route::prefix('/fields')->group(function(){
        Route::get('/', [FieldController::class, 'index']);
        Route::get('/{id}', [FieldController::class, 'show']);
        Route::post('/create', [FieldController::class, 'store']);
        Route::put('/{id}', [FieldController::class, 'update']);
        Route::delete('/{id}', [FieldController::class, 'destroy']);
    });
    Route::prefix('/rental')->group(function(){
        Route::get('/', [RentalFileController::class, 'index']);
        Route::get('/{id}', [RentalFileController::class, 'show']);
        Route::post('/create', [RentalFileController::class, 'store']);
        Route::put('/{id}', [RentalFileController::class, 'update']);
        Route::delete('/{id}', [RentalFileController::class, 'destroy']);
    });
    Route::prefix('/files')->group(function(){
        Route::get('/', [FileController::class, 'index']);
        Route::get('/{id}', [FileController::class, 'show']);
        Route::post('/create', [FileController::class, 'store']);
        Route::put('/{id}', [FileController::class, 'update']);
        Route::delete('/{id}', [FileController::class, 'destroy']);
    });
    Route::prefix('/guarantors')->group(function(){
        Route::get('/', [GuarantorController::class, 'index']);
        Route::get('/{id}', [GuarantorController::class, 'show']);
        Route::post('/create', [GuarantorController::class, 'store']);
        Route::put('/{id}', [GuarantorController::class, 'update']);
        Route::delete('/{id}', [GuarantorController::class, 'destroy']);
    });
});