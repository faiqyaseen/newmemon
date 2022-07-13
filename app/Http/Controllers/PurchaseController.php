<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGasInRequest;
use App\Http\Requests\UpdateGasInRequest;
use App\Models\Company;
use App\Models\Cylinder;
use App\Models\SalesPurchases;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = SalesPurchases::getPurchaseRecord(['sales_purchases.sale_purchase' => 1]);

        return view('purchases.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get();

        return view('purchases.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGasInRequest $request)
    {
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;
        $other = $request->others;
        $rate = $request->rate;
        $date = $request->date;
        $vehicle_name = $request->vehicle_name;
        $vehicle_number = $request->vehicle_number;
        $driver = $request->driver;
        $conductor = $request->conductor;
        $company = $request->company_id;
        $kg_count = 0;
        $remarks = 
            ($commercial == '' ? 0 : $commercial)
            . ';' . ($domestic == '' ? 0 : $domestic)
            . ';' . ($domestic6 == '' ? 0 : $domestic6)
            . ';' . ($domestic10 == '' ? 0 : $domestic10)
            . ';' . ($other == '' ? 0 : $other);

        if ($commercial != '' && $commercial != 0) {
            $kg_count = $kg_count + ($commercial * 45.4);
        }

        if ($domestic != '' && $domestic != 0) {
            $kg_count = $kg_count + ($domestic * 11.8);
        }

        if ($domestic6 != '' && $domestic6 != 0) {
            $kg_count = $kg_count + ($domestic6 * 6);
        }

        if ($domestic10 != '' && $domestic10 != 0) {
            $kg_count = $kg_count + ($domestic10 * 10);
        }

        if ($other != '' && $other != 0) {
            $kg_count = $kg_count + $other;
        }

        if ($kg_count == 0) {
            return redirect()
                ->route('purchases.index')
                ->with('warning', 'Record has not been saved.');
        } else {
            SalesPurchases::create([
                'sale_purchase' => 1,
                'kg' => $kg_count,
                'rate' => $rate,
                'sale_purchase_date' => $date,
                'remarks' => $remarks,
                'driver' => $driver,
                'conductor' => $conductor,
                'vehicle_name' => $vehicle_name,
                'vehicle_number' => $vehicle_number,
                'company_id' => $company,
            ]); 

            if ($commercial > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 0,
                    'branch_id' => 1,
                    'type' => 1
                ])->limit($commercial)->orderByDesc('id')->update(['is_filled' => 1]);
            }

            if ($domestic > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 0,
                    'branch_id' => 1,
                    'type' => 2
                ])->limit($domestic)->orderByDesc('id')->update(['is_filled' => 1]);
            }

            if ($domestic6 > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 0,
                    'branch_id' => 1,
                    'type' => 3
                ])->limit($domestic6)->orderByDesc('id')->update(['is_filled' => 1]);
            }

            if ($domestic10 > 0) {
                Cylinder::where([
                    'status' => 1,
                    'assign_to' => 0,
                    'sell_to' => 0,
                    'is_filled' => 0,
                    'branch_id' => 1,
                    'type' => 4
                ])->limit($domestic10)->orderByDesc('id')->update(['is_filled' => 1]);
            }
        }
        return redirect()
            ->route('purchases.index')
            ->with('success', 'Record has been saved Succesfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SalesPurchases::getGasRecord(['sales_purchases.sale_purchase' => 1, 'sales_purchases.id' => $id])->first();
        return view('purchases.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::get();
        $data = SalesPurchases::getGasRecord(['sales_purchases.sale_purchase' => 1, 'sales_purchases.id' => $id])->first();
        return view('purchases.edit', compact('data', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGasInRequest $request, $id)
    {
        $commercial = $request->commercial;
        $domestic = $request->domestic;
        $domestic6 = $request->domestic6;
        $domestic10 = $request->domestic10;
        $other = $request->others;
        $rate = $request->rate;
        $date = $request->date;
        $vehicle_name = $request->vehicle_name;
        $vehicle_number = $request->vehicle_number;
        $driver = $request->driver;
        $conductor = $request->conductor;
        $company = $request->company_id;
        $kg_count = 0;
        $remarks = 
            ($commercial == '' ? 0 : $commercial)
            . ';' . ($domestic == '' ? 0 : $domestic)
            . ';' . ($domestic6 == '' ? 0 : $domestic6)
            . ';' . ($domestic10 == '' ? 0 : $domestic10)
            . ';' . ($other == '' ? 0 : $other);

        if ($commercial != '' && $commercial != 0) {
            for ($i=0; $i < $commercial; $i++) { 
                $kg_count = $kg_count + 45.4;
            }
        }

        if ($domestic != '' && $domestic != 0) {
            for ($i=0; $i < $domestic; $i++) { 
                $kg_count = $kg_count + 11.8;
            }
        }

        if ($domestic6 != '' && $domestic6 != 0) {
            for ($i=0; $i < $domestic6; $i++) { 
                $kg_count = $kg_count + 6;
            }
        }

        if ($domestic10 != '' && $domestic10 != 0) {
            for ($i=0; $i < $domestic10; $i++) { 
                $kg_count = $kg_count + 10;
            }
        }

        if ($other != '' && $other != 0) {
            $kg_count = $kg_count + $other;
        }

        SalesPurchases::where('id', $id)->update([
            'kg' => $kg_count,
            'rate' => $rate,
            'sale_purchase_date' => $date,
            'remarks' => $remarks,
            'driver' => $driver,
            'conductor' => $conductor,
            'vehicle_name' => $vehicle_name,
            'vehicle_number' => $vehicle_number,
            'company_id' => $company,
        ]);

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Record has been updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalesPurchases::where(['sale_purchase' => 1, 'id' => $id])->delete();
        return redirect()
            ->route('purchases.index')
            ->with('success', 'Record has been deleted successfully');
    }
}
