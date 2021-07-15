<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use Illuminate\Http\Request;

class PaymentDetailController extends Controller
{
    //
    public function all()
    {
        return PaymentDetail::all();
    }

    public function testAdd()
    {
        return PaymentDetail::updateOrCreate(['id' => null], (array) json_decode(json_encode(new PaymentDetail)));
    }
}
