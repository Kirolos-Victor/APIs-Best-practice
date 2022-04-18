<?php

use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->group(function(){
    //lists
    Route::apiResource('lists',\App\Http\Controllers\API\ListController::class);
    Route::post('lists/filter',[\App\Http\Controllers\API\ListController::class,'filterLists']);
    //tasks
    Route::apiResource('tasks',\App\Http\Controllers\API\TaskController::class);
    Route::post('tasks/{task}/status',[\App\Http\Controllers\API\TaskController::class,'updateStatus']);
    //Update timezone for the user
    Route::post('update-timezone',[AuthController::class,'updateTimezone']);

});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
