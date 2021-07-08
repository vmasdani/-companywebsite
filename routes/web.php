<?php

use App\Http\Controllers\ProductController;
use App\Models\Payment;
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
    return view('login');
});




Route::get('/test-send-payment', function () {
    $make_pay = new Payment;


    Payment::updateOrCreate(['id' => 0], [$make_pay]);


    // return [
    //     'test' => 'hellloi',
    //     'hi' => 'people!'
    // ];
});

Route::get('/products', [ProductController::class, 'all']);
Route::get('/products-dummy-create', [ProductController::class, 'dummy_create']);

