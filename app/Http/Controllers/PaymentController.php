<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use PDO;

class PaymentController extends Controller
{
    public function test()
    {
        return ['test' => 'helllo'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function jwt_verify_test()
    {
        return [
            'test' => 'hello'
        ];
    }

    public function save(Request $request)
    {
        $paymentsData = json_decode($request->getContent());

        $payments = [];

        foreach ($paymentsData as $payment) {
            foreach ($payment->payments as $paymentTable) {
                $paymentObj = new Payment((array) json_decode(json_encode($paymentTable)));

                if ($payment->user) {
                    $paymentObj->user_id = $payment->user->id;
                }

                // if ($paymentObj->date) {
                //     $paymentObj->date = date('Y-m-d H:i:s', $paymentObj->date);
                // }



                var_dump($paymentObj->id);

                Payment::updateOrCreate(['id' => $paymentObj->id], (array) json_decode($paymentObj));
            }
        }

        return $paymentsData;
    }
}
