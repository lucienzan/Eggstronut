<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManageController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/',[BlogController::class,'index'])->name('index');
Route::get('/detail/{slug}',[BlogController::class,'detail'])->name('detail');
Route::get('/category/{slug}',[BlogController::class,'category'])->name('baseOnCategory');
Route::get('/name/{name}',[BlogController::class,'name'])->name('baseOnName');
Route::get('/date/{date}',[BlogController::class,'date'])->name('baseOnDate');


Route::view('/about','blog.about')->name('about');


Auth::routes();

Route::prefix('dashboard')->middleware(['auth','isBanned'])->group(function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/category',CategoryController::class);
    Route::resource('/article',ArticleController::class);


    Route::prefix('profile')->group(function(){
    Route::get('/user-manage',[UserManageController::class,'index'])->name('user.manage');
    Route::post('/user-manage/change-role',[UserManageController::class,'changeRole'])->name('user-manage.role');
    Route::post('/user-manage/ban-role',[UserManageController::class,'banRole'])->name('user-manage.ban-role');

    Route::resource('/user', UserController::class);
    Route::get('/password', [UserController::class,'changePassword'])->name('user.changePassword');
    Route::post('/password/update-password/', [UserController::class,'updatePassword'])->name('user.updatePassword');
    Route::post('/name/update-name', [UserController::class,'updateName'])->name('user.updateName');
    Route::put('/email/update-email/{id}', [UserController::class,'updateEmail'])->name('user.updateEmail');
    Route::post('/update-user-info',[UserController::class,'updateInfo'])->name('profile.update.info');
    });
});



