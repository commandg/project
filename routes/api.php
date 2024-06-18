<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'user'], function () {

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});
Route::group(['prefix' => 'admin'], function () {
    Route::put('/update-teacher-status/{userId}', [TeacherController::class, 'updateTeacherStatus']);
    Route::put('deleteTeacher/{userId}', [TeacherController::class, 'deleteTeacher']);
});

