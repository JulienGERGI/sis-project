<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\AdminController;
use App\Http\Controllers\ZoomIntegrationController;
use App\Http\Controllers\JobPostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'AuthLogin']);
Route::get('logout',[AuthController::class,'logout']);
Route::get('forgot-password',[AuthController::class,'forgotpassword']);
Route::post('forgot-password',[AuthController::class,'postForgotPassword']);
Route::get('reset/{token}',[AuthController::class,'reset']);
Route::post('reset/{token}',[AuthController::class,'PostReset']);


Route::post('/createWebinar',[ZoomIntegrationController::class,'createMeeting']);
Route::get('createWebinar',[ZoomIntegrationController::class,'goToCreate'])->name('createWebinar');





Route::group(['middleware'=>'admin'],function (){

    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('admin/admin/list', [AdminController::class,'list']);
    Route::get('admin/admin/add', [AdminController::class,'add']);
    Route::post('admin/admin/add', [AdminController::class,'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class,'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class,'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class,'delete']);





});




Route::group(['middleware'=>'teacher'],function (){

    Route::get('teacher/dashboard',[DashboardController::class,'dashboard']);


});
Route::group(['middleware'=>'student'],function (){

    Route::get('student/dashboard',[DashboardController::class,'dashboard']);

});
Route::group(['middleware'=>'parent'],function (){

    Route::get('parent/dashboard',[DashboardController::class,'dashboard']);

});

Route::group(['middleware'=>'alumni'],function (){

    // Route::get('alumni/dashboard',[ZoomIntegrationController::class,'getWebinarsOfCurrentAlumni'])->name('alumniDashboard');
    Route::get('alumni/dashboard',[DashboardController::class,'dashboard']);

    Route::get("goToCreateJob",[JobPostController::class,'goToCreateJob'])->name("goToCreateJob");
Route::post("/createJob",[JobPostController::class,'postJob'])->name("createJob");
Route::put("updateJob",[JobPostController::class,'updateJob'])->name("updateJob");
Route::delete("deleteJob",[JobPostController::class,'deleteJob'])->name("deleteJob");
});
Route::get("updateProfile",[AuthController::class,'goToUpdateProfile'])->name("goToUpdateProfile");
Route::put("updateProfile",[AuthController::class,'updateProfile'])->name("updateProfile");






