<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GroupController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'user'], function () {

    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('createMessage', [MessageController::class, 'createMessage']);
    Route::post('editMessage', [MessageController::class, 'editMessage']);
    Route::put('deleteMessage/{messageId}', [MessageController::class, 'deleteMessage']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});
Route::group(['prefix' => 'admin'], function () {
    Route::put('/update-teacher-status/{userId}', [TeacherController::class, 'updateTeacherStatus']);
    Route::put('deleteTeacher/{teacherId}', [TeacherController::class, 'deleteTeacher']);
    Route::put('createGroup', [GroupController::class, 'createGroup']);
    Route::put('deleteGroup/{groupId}', [GroupController::class, 'deleteGroup']);
});

Route::prefix('teacher')->group(function () {
    Route::post('addCourse', [CourseController::class, 'addCourse']);
    Route::post('editCourse/{courseId}', [CourseController::class, 'editCourse']);
    Route::get('viewTeacherCourses/{teacherId}', [CourseController::class, 'viewTeacherCourses']);
    Route::put('deleteCourse/{courseId}', [CourseController::class, 'deleteCourse']);
});

