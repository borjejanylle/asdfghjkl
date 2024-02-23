<?php

use App\Http\Controllers\API\TeacherApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ManagerApiContoller;
use App\Http\Controllers\API\ClassApiContoller;
use App\Http\Controllers\API\SubjectApiController;
use App\Http\Controllers\API\ClassSubjectApiController;
use App\Http\Controllers\API\ProjectApiController;



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

Route::post('/auth/register',[UserController::class,'register']);
Route::post('/auth/login', [UserController::class,'login']);
Route::post('/profile/change-password',[ProfileController::class,'change_password'])->middleware('auth:sanctum');
Route::post('/profile/update-profile',[ProfileController::class,'update_profile'])->middleware('auth:sanctum');

Route::get('/auth/user',[UserController::class,'user'])->middleware('auth:sanctum');
Route::get('/auth/logout',[UserController::class,'logout'])->middleware('auth:sanctum');





Route::middleware('auth:sanctum')->group(function(){
    Route::get('/admins',[ManagerApiContoller::class,'managerlist']);
    Route::post('/admins',[ManagerApiContoller::class,'add']);
    Route::get('/admins/{id}',[ManagerApiContoller::class,'edit']);
    Route::post('/admins/{id}',[ManagerApiContoller::class,'update']);
    Route::delete('/admins/{id}',[ManagerApiContoller::class, 'delete']);


    // Routes for ClassApiController


    Route::get('/classes',[ClassApiContoller::class,'list']);
    Route::post('/classes',[ClassApiContoller::class,'add']);
    Route::get('/classes/{id}', [ClassApiContoller::class, 'edit']);
    Route::put('/classes/{id}', [ClassApiContoller::class, 'update']);
    Route::delete('/classes/{id}', [ClassApiContoller::class, 'delete']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subjects', [SubjectApiController::class, 'list']);
    Route::post('/subjects', [SubjectApiController::class, 'add']);
    Route::get('/subjects/{id}', [SubjectApiController::class, 'edit']);
    Route::put('/subjects/{id}', [SubjectApiController::class, 'update']);
    Route::delete('/subjects/{id}', [SubjectApiController::class, 'delete']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/class_subjects', [ClassSubjectApiController::class, 'list']);
    Route::get('/class_subjects/add', [ClassSubjectApiController::class, 'add']);
    Route::post('/class_subjects/insert', [ClassSubjectApiController::class, 'insert']);
    Route::get('/class_subjects/edit/{id}', [ClassSubjectApiController::class, 'edit']);
    Route::put('/class_subjects/update/{id}', [ClassSubjectApiController::class, 'update']);
    Route::delete('/class_subjects/delete/{id}', [ClassSubjectApiController::class, 'delete']);
    Route::get('/class_subjects/{id}', [ClassSubjectApiController::class, 'getSingle']);
    Route::put('/class_subjects/{id}', [ClassSubjectApiController::class, 'updateSingle']);       
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/projects/insert', [ProjectApiController::class, 'insert']);
});
















