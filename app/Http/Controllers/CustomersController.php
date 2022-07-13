<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Customer::get();
        return view('customers.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'cnic_pic',
            'location_pic',
        ]);

        if ($request->hasFile('cnic_pic')) {
            $image = $request->file('cnic_pic');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'cnic-'. $data['first_name'] . '-' . time(). '.' . $extension;
            $image->move(public_path('assets/img/cnic/'), $ImageName);
            $data['cnic_pic'] = $ImageName;
        }

        if ($request->hasFile('location_pic')) {
            $image = $request->file('location_pic');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'location-'. $data['first_name'] . '-' . time(). '.' . $extension;
            $image->move(public_path('asset/img/locations/'), $ImageName);
            $data['location_pic'] = $ImageName;
        }

        Customer::create($data);

        return redirect()
            ->route('customers.index')
            ->with('success','Customer has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Customer::where('id', $id)->first();
        return view('customers.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Customer::where('id', $id)->first();
        return view('customers.show', compact('data'));
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
