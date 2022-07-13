<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCylOrderRequest;
use App\Models\Customer;
use App\Models\Cylinder;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Order::getOrdersWithTotalProducts()->get();
        return view('orders.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('status', 1)->get();
        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCylOrderRequest $request)
    {
        if (
            ($request->commercial == '' || $request->commercial == 0) &&
            ($request->domestic == '' || $request->domestic == 0) &&
            ($request->domestice == '' || $request->domestic6 == 0)
        ) {
            return redirect()
            ->route('orders.index')
            ->with('danger','Order not created');
        } else {
            $dt = date('Y-m-d H:i:s');
            $data = [];
            $customer_id = $request->customer_id;

            $order_id = Order::create([
                'customer_id' => $customer_id,
                'order_type' => 1,
                'remarks' => $request->remarks,
                'driver' => $request->driver,
                'vehicle_name' => $request->vehicle_name,
                'vehicle_number' => $request->vehicle_number,
                'conductor' => $request->conductor,
                'location' => $request->location
            ])->id;

            $total_amount = 0;
            $total_discount = 0;
            $total_amount_after_discount = 0;
            if ($request->commercial != '' || $request->commercial != 0) {
                $type = 1;
                $price = $request->commercial_rate;
                $discount = ($request->commercial_discount != '' || $request->commercial_discount != 0 ? $request->commercial_discount : 0);
                $amount_after_discount = $price - $discount;
                for ($i = 0; $i < $request->commercial; $i++) {
                    array_push($data, [
                        'type' => $type,
                        'price' => $price,
                        'discount' => $discount,
                        'amount_after_discount' => $amount_after_discount,
                        'order_id' => $order_id,
                        'created_at' => $dt,
                        'updated_at' => $dt
                    ]);
                    $total_amount = $total_amount + $price;
                    $total_discount = $total_discount + $discount;
                    $total_amount_after_discount = $total_amount_after_discount + $amount_after_discount;
                }
            }
            if ($request->domestic != '' || $request->domestic != 0) {
                $type = 2;
                $price = $request->domestic_rate;
                $discount = ($request->domestic_discount != '' || $request->domestic_discount != 0 ? $request->domestic_discount : 0);
                $amount_after_discount = $price - $discount;
                for ($i = 0; $i < $request->domestic; $i++) {
                    array_push($data, [
                        'type' => $type,
                        'price' => $price,
                        'discount' => $discount,
                        'amount_after_discount' => $amount_after_discount,
                        'order_id' => $order_id,
                        'created_at' => $dt,
                        'updated_at' => $dt
                    ]);
                    $total_amount = $total_amount + $price;
                    $total_discount = $total_discount + $discount;
                    $total_amount_after_discount = $total_amount_after_discount + $amount_after_discount;
                }
            }
            if ($request->domestic6 != '' || $request->domestic6 != 0) {
                $type = 3;
                $price = $request->domestic6_rate;
                $discount = ($request->domestic6_discount != '' || $request->domestic6_discount != 0 ? $request->domestic6_discount : 0);
                $amount_after_discount = $price - $discount;
                for ($i = 0; $i < $request->domestic6; $i++) {
                    array_push($data, [
                        'type' => $type,
                        'price' => $price,
                        'discount' => $discount,
                        'amount_after_discount' => $amount_after_discount,
                        'order_id' => $order_id,
                        'created_at' => $dt,
                        'updated_at' => $dt
                    ]);
                    $total_amount = $total_amount + $price;
                    $total_discount = $total_discount + $discount;
                    $total_amount_after_discount = $total_amount_after_discount + $amount_after_discount;
                }
            }
            OrdersProduct::insert($data);

            $cash_amount = 0;
            if ($request->pay != '' || $request->pay != 0) {
                $cash_amount = $request->pay;
            }

            Order::where('id', $order_id)->update([
                'discount' => $total_discount,
                'total_amount' => $total_amount,
                'amount_after_discount' => $total_amount_after_discount,
                'cash_amount' => $cash_amount
            ]);

            return redirect()
               ->route('orders.index')
               ->with('success','Orders has been created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Order::getOrdersWithTotalProducts(['orders.id' => $id])->first();
        $products = OrdersProduct::where('order_id', $id)->orderBy('type', 'ASC')->get();

        return view('orders.show', compact('data', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Order::getOrdersWithTotalProducts(['orders.id' => $id])->first();
        $customers = Customer::where('status', 1)->get();

        return view('orders.edit', compact('customers', 'data'));
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
        $commercial_count = OrdersProduct::where(['order_id' => $id, 'type' => 1])->count();
        $domestic_count = OrdersProduct::where(['order_id' => $id, 'type' => 2])->count();
        $domestic6_count = OrdersProduct::where(['order_id' => $id, 'type' => 3])->count();
        $dt = date('Y-m-d H:i:s');
        if ($commercial_count > $request->commercial) {
            $count = $commercial_count - $request->commercial;
            OrdersProduct::where(['order_id' => $id, 'type' => 1])->limit($count)->delete();
        } else if ($commercial_count < $request->commercial) {
            $count =  $request->commercial - $commercial_count;
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                array_push($data, [
                    'order_id' => $id,
                    'type' => 1,
                    'price' => $request->commercial_rate,
                    'discount' => $request->commercial_discount,
                    'amount_after_discount' => $request->commercial_rate - $request->commercial_discount,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                ]);
            }
            OrdersProduct::insert($data);
        }

        if ($domestic_count > $request->domestic) {
            $count = $domestic_count - $request->domestic;
            OrdersProduct::where(['order_id' => $id, 'type' => 2])->limit($count)->delete();
        } else if ($domestic_count < $request->domestic) {
            $count =  $request->domestic - $domestic_count;
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                array_push($data, [
                    'order_id' => $id,
                    'type' => 2,
                    'price' => $request->domestic_rate,
                    'discount' => $request->domestic_discount,
                    'amount_after_discount' => $request->domestic_rate - $request->domestic_discount,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                ]);
            }
            OrdersProduct::insert($data);
        }

        if ($domestic6_count > $request->domestic6) {
            $count = $domestic6_count - $request->domestic6;
            OrdersProduct::where(['order_id' => $id, 'type' => 3])->limit($count)->delete();
        } else if ($domestic6_count < $request->domestic6) {
            $count =  $request->domestic6 - $domestic6_count;
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                array_push($data, [
                    'order_id' => $id,
                    'type' => 2,
                    'price' => $request->domestic6_rate,
                    'discount' => $request->domestic6_discount,
                    'amount_after_discount' => $request->domestic6_rate - $request->domestic6_discount,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                ]);
            }
            OrdersProduct::insert($data);
        }

        $commercial_data = [
            'price' => $request->commercial_rate,
            'discount' => $request->commercial_discount
        ];

        $domestic_data = [
            'price' => $request->domestic_rate,
            'discount' => $request->domestic_discount
        ];

        $domestic6_data = [
            'price' => $request->domestic6_rate,
            'discount' => $request->domestic6_discount
        ];

        OrdersProduct::where(['order_id' => $id, 'type' => 1])->update($commercial_data);
        OrdersProduct::where(['order_id' => $id, 'type' => 2])->update($domestic_data);
        OrdersProduct::where(['order_id' => $id, 'type' => 3])->update($domestic6_data);

        $products = OrdersProduct::where('order_id', $id)->get();
        $total_amount = 0;
        $discount = 0;
        $amount_after_discount = 0;
        foreach ($products as $key => $product) {
            $total_amount = $total_amount + $product->price;
            $discount = $discount + $product->discount;
            $amount_after_discount = $amount_after_discount + $product->amount_after_discount;
        }

        $order_data = [
            'total_amount' => $total_amount,
            'discount' => $discount,
            'amount_after_discount' => $amount_after_discount,
            'cash_amount' => $request->pay,
            'vehicle_name' => $request->vehicle_name,
            'vehicle_number' => $request->vehicle_number,
            'driver' => $request->driver,
            'conductor' => $request->conductor,
            'location' => $request->location,
        ];

        $payment = Payment::where('order_id', $id)->pluck('payment')->first();
        $cash_amount = Order::where('id', $id)->pluck('cash_amount')->first();

        if ($payment == $cash_amount || $payment > $cash_amount) {
            $payment = $payment - $cash_amount;
            $payment = $payment + $request->pay;
        }

        Payment::where(['order_id' => $id])->update(['payment' => $payment]);

        Order::where('id', $id)->update($order_data);

        return redirect()
            ->route('orders.index')
            ->with('success','Orders has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Order::where('id', $id)->pluck('status')->first();
        if ($status == 3) {
            return redirect()
               ->route('orders.index')
               ->with('success','Order has already Cancelled.');
        } else {
            Order::where('id', $id)->update(['status' => 3]);
            $customer_id = Order::where('id', $id)->pluck('customer_id')->first();
    
            // If order was in pending status it means that payment has not created yet.
            if ($status != 2) {
                // Subtracting cash amount from payment because order has been cancelled
                $cash_amount = Order::where('id', $id)->pluck('cash_amount')->first();
                $payment = Payment::where('order_id', $id)->pluck('payment')->first();
                $payments = $payment - $cash_amount;
                Payment::where(['order_id' => $id, 'order_type' => 1])->update(['payment' => $payments]);

                $commercial_count = OrdersProduct::where(['order_id' => $id, 'type' => 1])->count();
                $domestic_count = OrdersProduct::where(['order_id' => $id, 'type' => 2])->count();
                $domestic6_count = OrdersProduct::where(['order_id' => $id, 'type' => 3])->count();
                $domestic10_count = OrdersProduct::where(['order_id' => $id, 'type' => 4])->count();

                if ($commercial_count > 0) {
                    Cylinder::where([
                        'status' => 1,
                        'assign_to' => $customer_id,
                        'sell_to' => 0,
                        'is_filled' => 1,
                        'branch_id' => 1,
                        'type' => 1
                    ])->limit($commercial_count)->orderByDesc('id')->update(['assign_to' => 0]);
                }

                if ($domestic_count > 0) {
                    Cylinder::where([
                        'status' => 1,
                        'assign_to' => $customer_id,
                        'sell_to' => 0,
                        'is_filled' => 1,
                        'branch_id' => 1,
                        'type' => 2
                    ])->limit($domestic_count)->orderByDesc('id')->update(['assign_to' => 0]);
                }

                if ($domestic6_count > 0) {
                    Cylinder::where([
                        'status' => 1,
                        'assign_to' => $customer_id,
                        'sell_to' => 0,
                        'is_filled' => 1,
                        'branch_id' => 1,
                        'type' => 3
                    ])->limit($domestic6_count)->orderByDesc('id')->update(['assign_to' => 0]);
                }

                if ($domestic10_count > 0) {
                    Cylinder::where([
                        'status' => 1,
                        'assign_to' => $customer_id,
                        'sell_to' => 0,
                        'is_filled' => 1,
                        'branch_id' => 1,
                        'type' => 4
                    ])->limit($domestic10_count)->orderByDesc('id')->update(['assign_to' => 0]);
                }
            }
        }

        return redirect()
               ->route('orders.index')
               ->with('success','Order has Cancelled successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $status = Order::where('id', $id)->pluck('status')->first();
        if ($status == 1) {
            return redirect()
               ->route('orders.index')
               ->with('success','Order has already confirmed.');
        } else {
            Order::where('id', $id)->update(['status' => 1]);
            $order = Order::where('id', $id)->first();
            if (!Payment::where(['order_id' => $id, 'order_type' => 1])->exists()) {
                // Creating payment for order 
                Payment::create([
                    'payment' => $order->cash_amount,
                    'order_id' => $id,
                    'order_type' => 1,
                    'customer_id' => $order->customer_id,
                ]);
            }else {
                // Adding cash amount to payment because payment has already been created for this order
                if ($order->cash_amount != 0.00) {
                    $payment = Payment::where('order_id', $id)->pluck('payment')->first();
                    $payments = $payment + $order->cash_amount;
                    Payment::where(['order_id' => $id])->update(['payment' => $payments]);
                }
            }

            $commercial_count = OrdersProduct::where(['order_id' => $id, 'type' => 1])->count();
            $domestic_count = OrdersProduct::where(['order_id' => $id, 'type' => 2])->count();
            $domestic6_count = OrdersProduct::where(['order_id' => $id, 'type' => 3])->count();
            $domestic10_count = OrdersProduct::where(['order_id' => $id, 'type' => 4])->count();

            if ($commercial_count > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 1,
                    'branch_id' => 1,
                    'type' => 1
                ])->limit($commercial_count)->orderByDesc('id')->update(['assign_to' => $order->customer_id]);
            }

            if ($domestic_count > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 1,
                    'branch_id' => 1,
                    'type' => 2
                ])->limit($domestic_count)->orderByDesc('id')->update(['assign_to' => $order->customer_id]);
            }

            if ($domestic6_count > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 1,
                    'branch_id' => 1,
                    'type' => 3
                ])->limit($domestic6_count)->orderByDesc('id')->update(['assign_to' => $order->customer_id]);
            }

            if ($domestic10_count > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 1,
                    'branch_id' => 1,
                    'type' => 4
                ])->limit($domestic10_count)->orderByDesc('id')->update(['assign_to' => $order->customer_id]);
            }
        }

        return redirect()
               ->route('orders.index')
               ->with('success','Order has been confirmed successfully.');
    }

    public function remainings(Request $request)
    {
        $records = payment::where('customer_id', $request->customer_id)->get();
        $total_paid = 0;
        $total_amount = 0;
        $order = Order::where(['customer_id' => $request->customer_id, 'status' => 1])->get();
        foreach ($order as $total) {
            $total_amount = $total_amount + $total->amount_after_discount;
        }
        foreach ($records as  $value) {
            $total_paid = $total_paid + $value->payment;
        }

        $remaining = $total_amount - $total_paid;
        return response()->json($remaining);
    }
}
