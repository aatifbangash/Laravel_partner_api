<?php

use App\Http\Controllers\Members;
use App\Models\Store;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', fn (Request $request) => "Working.");

Route::prefix('users')->group(function () {
    Route::get("/{uniqueCode}", [Members::class, 'getUser']);
    Route::post("/{uniqueCode}", [Members::class, 'updateUser']);
});
