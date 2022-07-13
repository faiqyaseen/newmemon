<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayementRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myrecords = payment::getPaymentWithCustomers()->get();
        // return $myrecords;
        $previousid = null;
        $records = [];
        $total_amount = 0;
        $total_paid = 0;
        $total_orders = 0;
        $first_name = '';
        $last_name = '';
        $email = '';
        $updated_at = '';
        foreach ($myrecords as $key => $record) {
            if ($key == 0) {
                $previousid == $record->customer_id;
                $first_name = $record->customer_first_name;
                $last_name = $record->customer_last_name;
                $email = $record->customer_email;
                $total_orders = $record->total_orders;
                $updated_at = $record->payment_updated_at; 
            }

            if ($previousid != $record->customer_id && $key != 0) {
                $remaining = $total_amount - $total_paid;
                array_push($records, [
                    'customer_id' => $previousid,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'total_amount' => $total_amount,
                    'remaining' => $remaining,
                    'total_orders' => $total_orders,
                    'total_paid' => $total_paid,
                    'updated_at' => $updated_at
                ]);
                $total_amount = 0;
                $remaining = 0;
                $total_paid = 0;
            }

            $total_amount = $total_amount + $record->order_amount;
            $total_paid = $total_paid + $record->payment;

            $first_name = $record->customer_first_name;
            $last_name = $record->customer_last_name;
            $email = $record->customer_email;
            $total_orders = $record->total_orders;
            if ($updated_at < $record->payment_updated_at) {
                $updated_at = $record->payment_updated_at;
            }
            if ($key == count($myrecords) - 1) {
                $remaining = $total_amount - $total_paid;
                array_push($records, [
                    'customer_id' => $record->customer_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'total_amount' => $total_amount,
                    'remaining' => $remaining,
                    'total_orders' => $total_orders,
                    'total_paid' => $total_paid,
                    'updated_at' => $updated_at
                ]);
            }
            $previousid = $record->customer_id;
        }
        return view('payment.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('status', 1)->get();
        return view('payment.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayementRequest $request)
    {
        $payment = $request->payment;
        $customer_id = $request->customer_id;
        if (!Customer::where('id', $customer_id)->exists()) {
            return redirect()->back()->with('error', 'Customer not found');   
        }

        $data = $request->except([
            '_token',
            '_method'
        ]);

        payment::create($data);

        return redirect()
               ->route('payments.index')
               ->with('success','Payment has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = payment::where('customer_id', $id)->get();
        $customer = Customer::where('id', $id)->first();
        $total_paid = 0;
        $total_amount = 0;
        $order = Order::where(['customer_id' => $id, 'status' => 1])->get();
        foreach ($order as $total) {
            $total_amount = $total_amount + $total->amount_after_discount;
        }
        foreach ($records as  $value) {
            $total_paid = $total_paid + $value->payment;
        }
        $remaining = $total_amount - $total_paid;
        return view('payment.show', compact('records', 'customer', 'total_paid', 'remaining'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
