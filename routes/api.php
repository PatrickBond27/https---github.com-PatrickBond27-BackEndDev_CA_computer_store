<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DeveloperController;

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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// every route within these curly brackets require authentication token
Route::middleware('auth:sanctum')->group(function (){
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/auth/user',[AuthController::class, 'user']);

    // You need to be logged in for all computer functionality except get all and get by id
    Route::apiResource('/computers', ComputerController::class)->except((['index', 'show']));
    Route::apiResource('/brands', BrandController::class)->except((['index', 'show']));
    Route::apiResource('/developers', DeveloperController::class)->except((['index', 'show']));
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// The API routes that takes the resource and displays it on the web.
Route::get('/computers', [ComputerController::class, 'index']);
Route::get('/computers/{computer}', [ComputerController::class, 'show']);
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/brands/{brand}', [BrandController::class, 'show']);
Route::get('/developers', [DeveloperController::class, 'index']);
Route::get('/developers/{developer}', [DeveloperController::class, 'show']);

// Route::apiResource('/computers', ComputerController::class);
// Route::apiResource('/brands', BrandController::class);
// Route::resource('/brand', BrandController::class)->only(['index', 'show']);
// Route::apiResource('/developers', DeveloperController::class);