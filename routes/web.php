<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//home page(display all consultants)
Route::get('/',[ConsultantController::class,'index']);


//store appointment data
Route::post('/appointments' ,[AppointmentController::class,'store']);

//show create form
Route::get('/appointments/create', [AppointmentController::class,'create'])->middleware('auth');

//show edit form
Route::get('/appointments/{appointment}/edit',[AppointmentController::class,'edit'])->middleware('auth');

//update appointment
Route::put('/appointments/{appointment}',[AppointmentController::class,'update'])->middleware('auth');

//delete appointment
Route::delete('/appointments/{id}',[AppointmentController::class,'delete'])->middleware('auth');

//manage appointments
Route::get('/appointments/manage',[AppointmentController::class,'manage'])->middleware('auth');

//admin page
Route::get('/admin',[AdminController::class,'index']);

//show register/create form
Route::get('/Register',[UserController::class,'create']);

//show login form
Route::get('/login',[UserController::class, 'login']);




//show user edit form
Route::get('/users/{user}/edit',[UserController::class,'edit']);

//update user
Route::put('/users/{user}',[UserController::class,'update']);

//delete user
Route::delete('/users/{id}',[UserController::class,'delete']);





//delete consultant
Route::delete('/consultants/{id}',[ConsultantController::class,'delete']);

//show create form for consultant
Route::get('/consultants/create', [ConsultantController::class,'create']);

//store data for consultant
Route::post('/consultants' ,[ConsultantController::class,'store']);

//show edit form for consultant
Route::get('/consultants/{consultant}/edit',[ConsultantController::class,'edit']);

//update consultant
Route::put('/consultants/{consultant}',[ConsultantController::class,'update']);






//create new user
Route::post('/users',[UserController::class,'store']);

//log in user
Route::post('/users/authenticate',[UserController::class,'authenticate']);

//log user out
Route::post('/logout', [UserController::class, 'logout']);

//single appointments
Route::get('/appointments/{appointment}',[AppointmentController::class,'show']);
