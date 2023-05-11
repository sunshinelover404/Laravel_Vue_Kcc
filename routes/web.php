<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserdashboardController;
use App\Http\Controllers\AskFormController;
use App\Http\Controllers\LikeController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;


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

Route::get('/', function () {
    return view('home.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('register', [AdminAuthController::class, 'AdminRegisterView'])->name('register');
    Route::post('register', [AdminAuthController::class, 'AdminRegister'])->name('adminregister');
    Route::get('login', [AdminAuthController::class, 'AdminLoginView'])->name('login');
    Route::post('login', [AdminAuthController::class, 'AdminLogin'])->name('adminlogin');
    Route::get('dashboard', [AdminDashboard::class, 'Dashboard'])->name('dashboard')->middleware('admin');
    Route::get('adminprofile',[AdminDashboard::class,'ViewProfile'])->name('adminprofile')->middleware('admin');
    Route::get('adminusermanagement',[AdminDashboard::class,'UserManagement'])->name('adminusermanagement')->middleware('admin');
});






//user dashboard
Route::prefix('users')->name('user.')->group(function () {
    Route::get('dashboard', [UserdashboardController::class, 'UserDashboard'])->name('dashboard')->middleware('auth');
    Route::get('about', [UserdashboardController::class, 'createabout'])->name('about');
    Route::get('home', [UserdashboardController::class, 'home'])->name('home');
    Route::get('questiondetail', [UserdashboardController::class, 'questiondetail'])->name('questiondetail');
    Route::get('createask', [AskFormController::class, 'createask'])->name('createask');
    Route::post('createanswer', [UserdashboardController::class, 'createanswer'])->name('createanswer');
    Route::get('contactus',[UserdashboardController::class,'contactus'])->name('contactus');
    Route::post('storecontact',[UserdashboardController::class,'storecontact'])->name('storecontact');
    Route::get('userprofile',[UserdashboardController::class,'createuserprofile'])->name('userprofile');
    Route::get('getprofile',[UserdashboardController::class,'getprofile'])->name('getprofile');
    Route::get('updateprofile',[UserdashboardController::class,'updateprofile'])->name('updateprofile');
    Route::get('deleteprofile',[UserdashboardController::class,'deleteprofile'])->name('deleteprofile');
    
});

  
    Route::post('storeask', [AskFormController::class, 'storeask'])->name('storeask');
  

//  Route::get('mydata', function(Request $request){
//  dd($request);
    
// });

Route::get('getregister',[UserdashboardController::class,'getregister'])->name('getregister');
Route::get('getdata/{id}', [UserdashboardController::class, 'GetJasonResponse']);
Route::post('storeregister',[UserdashboardController::class,'storeregister'])->name('storeregister');
Route::get('logout',[UserdashboardController::class,'destory'])->name('logout');

Route::get('/livesearch', [UserdashboardController::class, 'getSearch']);
Route::get('/items/{id}', [UserdashboardController::class, 'getasked'])->name('items');


Route::post('/like', [LikeController::class, 'like'])->name('like');
Route::post('/dislike', [LikeController::class, 'dislike'])->name('dislike');


// Route::get('register', [RegisterController::class, 'index'])
//         ->name('register');