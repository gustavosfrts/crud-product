<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

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

Route::post('/login', [\App\Http\Controllers\Controller::class, 'login'])->name('api.login');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::prefix('/product')->group(function(){
        Route::get('/list/{id}', [ProdutoController::class, 'showOneProduto'])->name('api.show.one.product');
        Route::post('/list', [ProdutoController::class, 'showAllProducts'])->name('api.show.all.product');
        Route::post('/create', [ProdutoController::class, 'createProduct'])->name('api.create.product');
        Route::put('/update/{id}', [ProdutoController::class, 'updateProduct'])->name('api.update.product');
        Route::delete('/delete/{id}', [ProdutoController::class, 'deleteProduct'])->name('api.delete.product');
    });
});
