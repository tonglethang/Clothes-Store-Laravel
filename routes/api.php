<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('index', [ApiController::class, 'index'])->name('api.index');
Route::get('getProduct/{id}', [ApiController::class, 'getProduct'])->name('api.getProduct');
Route::post('addProduct', [ApiController::class, 'addProduct'])->name('api.addProduct');
Route::put('updateProduct/{id}', [ApiController::class, 'updateProduct'])->name('api.updateProduct');
Route::delete('deleteProduct/{id}', [ApiController::class, 'deleteProduct'])->name('api.deleteProduct');
