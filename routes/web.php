<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Payment;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login', ['baseUrl' => env('BASE_URL')]);
});

Route::get('/about', function () {
    return view('about', ['baseUrl' => env('BASE_URL')]);
});

Route::get('/users-page', function () {
    return view('users', [
        'baseUrl' => env('BASE_URL'),
        'users' => User::all()
    ]);
});

Route::get('/payment-admin', function () {
    return view('payment-admin', ['baseUrl' => env('BASE_URL')]);
});

Route::get('/payment-user', function () {
    return view('payment-user', ['baseUrl' => env('BASE_URL')]);
});






Route::post('/auth-login', [UserController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/jwt-verify-test', [PaymentController::class, 'jwt_verify_test']);
});



Route::get('/test-send-payment', function () {
    $make_pay = new Payment;


    Payment::updateOrCreate(['id' => 0], [$make_pay]);


    // return [
    //     'test' => 'hellloi',
    //     'hi' => 'people!'
    // ];
});

// Users
Route::get('/users', [UserController::class, 'all']);

// Users populate
Route::get('/users-populate', [UserController::class, 'populate']);

Route::get('/products', [ProductController::class, 'all']);
Route::get('/products-dummy-create', [ProductController::class, 'dummy_create']);
