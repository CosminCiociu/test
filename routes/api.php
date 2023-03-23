<?php

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

Route::get('/employees', [App\Http\Controllers\EmployeeController::class,'index']);
Route::get('/employee/{id}', [App\Http\Controllers\EmployeeController::class,'show']);

Route::get('/companies', [App\Http\Controllers\CompanyController::class,'index']);
Route::get('/company/{id}', [App\Http\Controllers\CompanyController::class,'show']);

Route::get('/projects', [App\Http\Controllers\ProjectController::class,'index']);
Route::get('/project/{id}', [App\Http\Controllers\ProjectController::class,'show']);

Route::post('/register',[App\Http\Controllers\ApiTokenController::class,'register']);
Route::post('/login',[App\Http\Controllers\ApiTokenController::class,'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[App\Http\Controllers\ApiTokenController::class,'logout']);

    Route::resource('employee', 'EmployeeController')->except('index','show');
    Route::resource('company', 'CompanyController')->except('index','show');
    Route::resource('project', 'ProjectController')->except('index','show');
});