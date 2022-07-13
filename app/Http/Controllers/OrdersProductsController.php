<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\payment;
use Illuminate\Http\Request;

class OrdersProductsController extends Controller
{
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = OrdersProduct::where('id', $id)->first();
        return view('orders_products.edit', compact('data'));
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
        $data = $request->except([
            '_method',
            '_token'
        ]);

        $data['amount_after_discount'] = $request->price - $request->discount;
        $total_order_amount = OrdersProduct::where('id', $id)->pluck('amount_after_discount')->first();
        OrdersProduct::where('id', $id)->update($data);
        $order_id = OrdersProduct::where('id', $id)->pluck('order_id')->first();
        $products = OrdersProduct::where('order_id', $order_id)->get();
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
            'amount_after_discount' => $amount_after_discount
        ];

        Order::where('id', $order_id)->update($order_data);

        $total_order_amount = payment::where(['order_id' => $order_id, 'order_type' => 1])->pluck('total_order_amount')->first() - $total_order_amount;
        payment::where(['order_id' => $order_id, 'order_type' => 1])->update(['total_order_amount' => $total_order_amount]);
        return redirect()
           ->route('orders.show', $order_id)
           ->with('success', 'Product has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_id = OrdersProduct::where('id', $id)->pluck('order_id')->first();
        $total_order_amount = OrdersProduct::where('id', $id)->pluck('amount_after_discount')->first();
        OrdersProduct::where('id', $id)->delete();
        $products = OrdersProduct::where('order_id', $order_id)->get();
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
            'amount_after_discount' => $amount_after_discount
        ];
        Order::where('id', $order_id)->update($order_data);
        $total_order_amount = payment::where(['order_id' => $order_id, 'order_type' => 1])->pluck('total_order_amount')->first() - $total_order_amount;
        payment::where(['order_id' => $order_id, 'order_type' => 1])->update(['total_order_amount' => $total_order_amount]);

        return redirect()
           ->route('orders.show', $order_id)
           ->with('success', 'Product has been deleted successfully.');
    }
}
