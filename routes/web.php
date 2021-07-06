<?php

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

Route::get('/test-send-payment', function () {
    $new_pay = new Payment;
    $new_pay->amount = 100;
    $new_pay->note = 'testnote'; 
    $new_pay->userId = 0;

    $new_pay->save();
    

    // return [
    //     'test' => 'hellloi',
    //     'hi' => 'people!'
    // ];
});
