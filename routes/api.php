<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('category')->group(function(){
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{category}', [CategoryController::class, 'fetchById']);
    Route::post('create', [CategoryController::class, 'create']);
    Route::put('update/{category}', [CategoryController::class, 'update']);
    Route::delete('delete/{category}', [CategoryController::class, 'delete']);
});

Route::prefix('product')->group(function(){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('{product}', [ProductController::class, 'fetchById']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::put('update/{product}', [ProductController::class, 'update']);
    Route::delete('delete/{product}', [ProductController::class, 'delete']);
});
