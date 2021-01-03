<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessesController;

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

Route::post('/businesses', [BusinessesController::class, 'store']);
Route::patch('/businesses/{business}', [BusinessesController::class, 'update']);
Route::patch('/businesses/deactivate/{business}', [BusinessesController::class, 'deactivate']);
Route::patch('/businesses/activate/{business}', [BusinessesController::class, 'activate']);
