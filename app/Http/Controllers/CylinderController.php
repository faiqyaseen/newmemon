<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellCylinderRequest;
use App\Http\Requests\StoreCylinderRequest;
use App\Models\Customer;
use App\Models\Cylinder;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CylinderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cylinder::getCylindersCount();
        $last_update = Carbon::createFromTimeStamp(strtotime(Cylinder::max('updated_at')))->diffForHumans();

        // return $data;
        return view('cylinders.index', compact('data', 'last_update'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cylinders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCylinderRequest $request)
    {
        // Commercial
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;

        $dt = date('Y-m-d H:i:s');
        $data = [];

        if ($commercial != 0 || $commercial != '') {
            $type = 1;
            $purchase_date = $request->commercial_date;
            $price = $request->commercial_price;
            for ($i=0; $i < $commercial; $i++) {
                array_push($data, [
                    'type' => $type,
                    'date_purchased' => $purchase_date,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                    'buy_price' => $price
                ]);
            }
        }
        if ($domestic != 0 || $domestic != '') {
            $type = 2;
            $purchase_date = $request->domestic_date;
            $price = $request->domestic_price;
            for ($i=0; $i < $domestic; $i++) {
                array_push($data, [
                    'type' => $type,
                    'date_purchased' => $purchase_date,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                    'buy_price' => $price
                ]);
            }
        }
        if ($domestic6 != 0 || $domestic6 != '') {
            $type = 3;
            $purchase_date = $request->domestic6_date;
            $price = $request->domestic6_price;
            for ($i=0; $i < $domestic6; $i++) {
                array_push($data, [
                    'type' => $type,
                    'date_purchased' => $purchase_date,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                    'buy_price' => $price
                ]);
            }
        }
        if ($domestic10 != 0 || $domestic10 != '') {
            $type = 4;
            $purchase_date = $request->domestic10_date;
            $price = $request->domestic10_price;
            for ($i=0; $i < $domestic10; $i++) {
                array_push($data, [
                    'type' => $type,
                    'date_purchased' => $purchase_date,
                    'created_at' => $dt,
                    'updated_at' => $dt,
                    'buy_price' => $price
                ]);
            }
        }

        Cylinder::insert($data);

        return redirect()
            ->route('cylinders.index')
            ->with('success','Cylinders has been added successfully.');
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

    public function modify()
    {
        return view('cylinders.edit');
    }

    public function modification(Request $request)
    {
        // 45 Kg Cylinders Entry
        $good_cylinders45 = $request->gcylinders45;
        $bad_cylinders45 = $request->bcylinders45;
        $worst_cylinders45 = $request->wcylinders45;

        // 11 Kg Cylinders Entry
        $good_cylinders11 = $request->gcylinders11;
        $bad_cylinders11 = $request->bcylinders11;
        $worst_cylinders11 = $request->wcylinders11;

        // 6 Kg Cylinders Entry
        $good_cylinders6 = $request->gcylinders6;
        $bad_cylinders6 = $request->bcylinders6;
        $worst_cylinders6 = $request->wcylinders6;

        if ($good_cylinders45 != 0 || $good_cylinders45 != '') {
            $type = 1;
            $condition = 1;
            for ($i=0; $i < $good_cylinders45; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($bad_cylinders45 != 0 || $bad_cylinders45 != '') {
            $type = 1;
            $condition = 2;
            for ($i=0; $i < $bad_cylinders45; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($worst_cylinders45 != 0 || $worst_cylinders45 != '') {
            $type = 1;
            $condition = 3;
            for ($i=0; $i < $worst_cylinders45; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($good_cylinders11 != 0 || $good_cylinders11 != '') {
            $type = 2;
            $condition = 1;
            for ($i=0; $i < $good_cylinders11; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($bad_cylinders11 != 0 || $bad_cylinders11 != '') {
            $type = 2;
            $condition = 2;
            for ($i=0; $i < $bad_cylinders11; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($worst_cylinders11 != 0 || $worst_cylinders11 != '') {
            $type = 2;
            $condition = 3;
            for ($i=0; $i < $worst_cylinders11; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($good_cylinders6 != 0 || $good_cylinders6 != '') {
            $type = 3;
            $condition = 1;
            for ($i=0; $i < $good_cylinders6; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($bad_cylinders6 != 0 || $bad_cylinders6 != '') {
            $type = 3;
            $condition = 2;
            for ($i=0; $i < $bad_cylinders6; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }
        
        if ($worst_cylinders6 != 0 || $worst_cylinders6 != '') {
            $type = 3;
            $condition = 3;
            for ($i=0; $i < $worst_cylinders6; $i++) {
                Cylinder::where(['type' => $type, 'condition' => $condition])->limit(1)->orderByDesc('id')->delete();
            }
        }

        return redirect()
            ->route('cylinders.index')
            ->with('success','Cylinders Has Been Deleted Successfully.');
    }

    public function sell()
    {
        $customers = Customer::where('status', 1)->get();
        return view('cylinders.sell', compact('customers'));
    }

    public function sold(SellCylinderRequest $request)
    {
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;

        if ($commercial != 0 || $commercial != '') {
            $type = 1;
            $condition = 1;
            $price = $request->commercial_price;
            Cylinder::where([
                'type' => $type,
                'condition' => $condition,
                'is_filled' => 0,
                'branch_id' => 1,
                'assign_to' => 0,
                'sell_to' => 0
            ])->limit($commercial)
                ->orderByDesc('id')
                ->update([
                    'sell_to' => $request->to_id,
                    'date_sell' => $request->date_of_sell,
                    'sell_price' => $price
            ]);
        }

        if ($domestic != 0 || $domestic != '') {
            $type = 2;
            $condition = 1;
            $price = $request->domestic_price;
            Cylinder::where([
                'type' => $type,
                'condition' => $condition,
                'sell_to' => 0
            ])->limit($domestic)
                ->orderByDesc('id')
                ->update([
                    'sell_to' => $request->to_id,
                    'date_sell' => $request->date_of_sell,
                    'sell_price' => $price
            ]);
        }

        if ($domestic6 != 0 || $domestic6 != '') {
            $type = 3;
            $condition = 1;
            $price = $request->domestic6_price;
            Cylinder::where([
                'type' => $type,
                'condition' => $condition,
                'sell_to' => 0
            ])->limit($domestic6)
                ->orderByDesc('id')
                ->update([
                    'sell_to' => $request->to_id,
                    'date_sell' => $request->date_of_sell,
                    'sell_price' => $price
            ]);
        }

        if ($domestic10 != 0 || $domestic10 != '') {
            $type = 4;
            $condition = 1;
            $price = $request->domestic10_price;
            Cylinder::where([
                'type' => $type,
                'condition' => $condition,
                'sell_to' => 0
            ])->limit($domestic10)
                ->orderByDesc('id')
                ->update([
                    'sell_to' => $request->to_id,
                    'date_sell' => $request->date_of_sell,
                    'sell_price' => $price
            ]);
        }

        return redirect()
            ->route('cylinders.index')
            ->with('success','Cylinders Has Been Sold Successfully.');
    }

    public function showSold()
    {
        $records = Cylinder::getSoldCylindersWithCustomers();
        $ids = [];
        $first_names = [];
        $last_names = [];
        $total_counts_by_every_customer = [];
        $previousid = null;
        $count = null;
        foreach ($records as $key => $record) {
            if ($previousid != $record->customers_id) {
                if ($count != null) {
                    array_push($total_counts_by_every_customer, $count);
                    $count = 0;
                }
                array_push($ids, $record->customers_id);
                array_push($first_names, $record->first_name);
                array_push($last_names, $record->last_name);
            }
            $count++;
            if ($key == count($records) - 1) {
                array_push($total_counts_by_every_customer, $count);
            }
            $previousid = $record->customers_id;
        }

        return view('cylinders.show', compact(
            'first_names',
            'last_names',
            'ids',
            'total_counts_by_every_customer',
            'records'
        ));
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

    public function empties()
    {
        $records = Cylinder::getCustomersEmpties();
        // return $data;

        return view('cylinders.empties', compact('records'));
    }

    public function getEmpties()
    {
        return view('cylinders.get_empties');
    }

    public function updateGetEmpties(Request $request)
    {
        $customer_id = $request->customer_id;
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;

        if (
            ($commercial == '' || $commercial == 0)
            && ($domestic == '' || $domestic == 0)
            && ($domestic6 == '' || $domestic6 == 0)
            && ($domestic10 == '' || $domestic10 == 0)
        ) {
            return redirect()->back();
        } else {
            if ($commercial != 0 || $commercial != '') {
                $type = 1;
                $condition = 1;
                Cylinder::where([
                    'type' => $type,
                    'condition' => $condition,
                    'assign_to' => $customer_id,
                ])->limit($commercial)
                ->orderByDesc('id')
                ->update(['assign_to' => 0, 'is_filled' => 0]);
            }
    
            if ($domestic != 0 || $domestic != '') {
                $type = 2;
                $condition = 1;
                Cylinder::where([
                    'type' => $type,
                    'condition' => $condition,
                    'assign_to' => $customer_id,
                ])->limit($domestic)
                ->orderByDesc('id')
                ->update(['assign_to' => 0, 'is_filled' => 0]);
            }
    
            if ($domestic6 != 0 || $domestic6 != '') {
                $type = 3;
                $condition = 1;
                Cylinder::where([
                    'type' => $type,
                    'condition' => $condition,
                    'assign_to' => $customer_id,
                ])->limit($domestic6)
                ->orderByDesc('id')
                ->update(['assign_to' => 0, 'is_filled' => 0]);
            }
    
            if ($domestic10 != 0 || $domestic10 != '') {
                $type = 4;
                $condition = 1;
                Cylinder::where([
                    'type' => $type,
                    'condition' => $condition,
                    'assign_to' => $customer_id,
                ])->limit($domestic10)
                ->orderByDesc('id')
                ->update(['assign_to' => 0, 'is_filled' => 0]);
            }   
        }
        return redirect()
           ->back()
           ->with('success', 'Record updated succesfully');
    }
}
