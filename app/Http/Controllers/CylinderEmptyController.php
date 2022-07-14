<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Cylinder;
use App\Models\CylinderEmpty;
use Illuminate\Http\Request;

class CylinderEmptyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Cylinder::getCustomersEmpties();

        return view('cylinder_empties.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        return view('cylinder_empties.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['customer_id' => 'required'],
            ['customer_id.required' => 'The customer field is required'],
        );
        $id = $request->customer_id;
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;

        if ($commercial != '' || $commercial != 0) {
            if ($commercial > 0 ) {
                Cylinder::where([
                    'assign_to' => 0,
                    'type' => 1,
                    'sell_to' => 0,
                    'is_filled' => 0,
                ])->limit($commercial)->orderByDesc('id')->update(['assign_to' => $id]);

                CylinderEmpty::create([
                    'type' => 0,
                    'cylinder_type' => 1,
                    'customer_id' => $id,
                    'quantity' => $commercial,
                ]);
            }
        }

        if ($domestic != '' || $domestic != 0) {
            if ($domestic > 0 ) {
                Cylinder::where([
                    'assign_to' => 0,
                    'type' => 2,
                    'sell_to' => 0,
                    'is_filled' => 0,
                ])->limit($domestic)->orderByDesc('id')->update(['assign_to' => $id]);

                CylinderEmpty::create([
                    'type' => 0,
                    'cylinder_type' => 2,
                    'customer_id' => $id,
                    'quantity' => $domestic,
                ]);
            }
        }

        if ($domestic6 != '' || $domestic6 != 0) {
            if ($domestic6 > 0 ) {
                Cylinder::where([
                    'assign_to' => 0,
                    'type' => 3,
                    'sell_to' => 0,
                    'is_filled' => 0,
                ])->limit($domestic6)->orderByDesc('id')->update(['assign_to' => $id]);

                CylinderEmpty::create([
                    'type' => 0,
                    'cylinder_type' => 3,
                    'customer_id' => $id,
                    'quantity' => $domestic6,
                ]);
            }
        }

        if ($domestic10 != '' || $domestic10 != 0) {
            if ($domestic10 > 0 ) {
                Cylinder::where([
                    'assign_to' => 0,
                    'type' => 4,
                    'sell_to' => 0,
                    'is_filled' => 0,
                ])->limit($domestic10)->orderByDesc('id')->update(['assign_to' => $id]);

                CylinderEmpty::create([
                    'type' => 0,
                    'cylinder_type' => 4,
                    'customer_id' => $id,
                    'quantity' => $domestic10,
                ]);
            }
        }

        return redirect()->route('empties.index')->with(['success' => 'Empties Record Updated Succesfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recieve()
    {
        $customers = Customer::get();
        return view('cylinder_empties.recieve', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recieved(Request $request)
    {
        $request->validate(
            ['customer_id' => 'required'],
            ['customer_id.required' => 'The customer field is required'],
        );

        $id = $request->customer_id;
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;

        if ($commercial != '' || $commercial != 0) {
            if ($commercial > 0 ) {
                Cylinder::where([
                    'assign_to' => $id,
                    'type' => 1,
                ])->limit($commercial)->orderByDesc('id')->update(['assign_to' => 0, 'is_filled' => 0]);

                CylinderEmpty::create([
                    'type' => 1,
                    'cylinder_type' => 1,
                    'customer_id' => $id,
                    'quantity' => $commercial,
                ]);
            }
        }

        if ($domestic != '' || $domestic != 0) {
            if ($domestic > 0 ) {
                Cylinder::where([
                    'assign_to' => $id,
                    'type' => 2,
                ])->limit($domestic)->orderByDesc('id')->update(['assign_to' => 0, 'is_filled' => 0]);

                CylinderEmpty::create([
                    'type' => 1,
                    'cylinder_type' => 2,
                    'customer_id' => $id,
                    'quantity' => $domestic,
                ]);
            }
        }

        if ($domestic6 != '' || $domestic6 != 0) {
            if ($domestic6 > 0 ) {
                Cylinder::where([
                    'assign_to' => $id,
                    'type' => 3,
                ])->limit($domestic6)->orderByDesc('id')->update(['assign_to' => 0, 'is_filled' => 0]);

                CylinderEmpty::create([
                    'type' => 1,
                    'cylinder_type' => 3,
                    'customer_id' => $id,
                    'quantity' => $domestic6,
                ]);
            }
        }

        if ($domestic10 != '' || $domestic10 != 0) {
            if ($domestic10 > 0 ) {
                Cylinder::where([
                    'assign_to' => $id,
                    'type' => 4,
                ])->limit($domestic10)->orderByDesc('id')->update(['assign_to' => 0, 'is_filled' => 0]);

                CylinderEmpty::create([
                    'type' => 1,
                    'cylinder_type' => 4,
                    'customer_id' => $id,
                    'quantity' => $domestic10,
                ]);
            }
        }

        return redirect()->route('empties.index')->with(['success' => 'Empties Record Updated Succesfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();
        $records = CylinderEmpty::where('customer_id', $id)->orderBy('id', 'DESC')->get();
        $empties = CylinderEmpty::countEmpties($id);

        return view('cylinder_empties.show', compact('records', 'customer', 'empties'));
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
