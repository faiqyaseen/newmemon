@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('orders.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
          <h6>Manage products Of Order #{{ $data->order_id }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', $data->order_id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="customer_id" class="form-control-label">Customer</label>
                    <select name="customer_id" class="form-control" id="customer_id">
                        <option value="" disabled selected>Select Customer</option>
                        @foreach ($customers as $customer)
                        @if (old('customer_id', $data->customer_id) == $customer->id)
                        <option value="{{ $customer->id }}" selected>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                        @else
                        <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('customer_id')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="commercial" class="form-control-label">Commercial Cylinder(45.4Kg)</label>
                            <input class="form-control" name="commercial" value="{{ old('commercial', $data->commercial_cylinders) }}" type="number" placeholder="Commercial Cylinders" id="commercial">
                            @error('commercial')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="commercial_rate" class="form-control-label">Commercial Rate</label>
                            <input class="form-control" type="number" name="commercial_rate" value="{{ old('commercial_rate', $data->commercial_cylinder_price) }}" id="commercial_rate">
                            @error('commercial_rate')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="commercial_discount" class="form-control-label">Discount On Commercial Cylinder</label>
                            <input class="form-control" type="number" name="commercial_discount" value="{{ old('commercial_discount', $data->commercial_cylinder_discount) }}"  id="commercial_discount">
                            @error('commercial_discount')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <p>Total Commercial (45.4) Rate: <b id="txt_comm"></b></p>
                            <p>After Discount Commercial (45.4) Rate: <b id="txt_dcomm"></b></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="domestic" class="form-control-label">Domestic Cylinder(11.8Kg)</label>
                            <input class="form-control" name="domestic" value="{{ old('domestic', $data->domestic_cylinders) }}" type="number" placeholder="Domestic Cylinders" id="domestic">
                            @error('domestic')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic_rate" class="form-control-label">Domestic Rate</label>
                            <input class="form-control" type="number" name="domestic_rate" value="{{ old('domestic_rate', $data->domestic_cylinder_price) }}" id="domestic_rate">
                            @error('domestic_rate')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic_discount" class="form-control-label">Discount On Domestic Cylinder</label>
                            <input class="form-control" type="number" name="domestic_discount" value="{{ old('domestic_discount', $data->domestic_cylinder_discount) }}"  id="domestic_discount">
                            @error('domestic_discount')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <p>Total Domestic (11.8) Rate: <span id="txt_dom"></span></p>
                            <p>After Discount Domestic (11.8) Rate: <span id="txt_ddom"></span></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="domestic6" class="form-control-label">Domestic Cylinder(6Kg)</label>
                            <input class="form-control" name="domestic6" value="{{ old('domestic6', $data->domestic6_cylinders) }}" type="number" placeholder="Domestic Cylinders (6Kg)" id="domestic6">
                            @error('domestic6')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic6_rate" class="form-control-label">Domestic (6Kg) Rate</label>
                            <input class="form-control" type="number" name="domestic6_rate" value="{{ old('domestic6_rate', $data->domestic6_cylinder_price) }}" id="domestic6_rate">
                            @error('domestic6_rate')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic6_discount" class="form-control-label">Discount On Domestic Cylinder (6kg)</label>
                            <input class="form-control" type="number" name="domestic6_discount" value="{{ old('domestic6_discount', $data->domestic6_cylinder_discount) }}"  id="domestic6_discount">
                            @error('domestic6_discount')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <p>Total Domestic (6) Rate: <span id="txt_dom6"></span></p>
                            <p>After Discount Domestic (6) Rate: <span id="txt_ddom6"></span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="">Total Rate:<span id="txt_total"></span></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="">Total Discount:<span id="txt_dis"></span></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="">After Discount Rate:<span id="txt_dtotal"></span></h6>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="remarks" class="form-control-label">Remarks</label>
                        <input class="form-control" type="text" name="remarks" value="{{ old('remarks', $data->remarks) }}"  id="remarks">
                        @error('remarks')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="pay" class="form-control-label">Pay</label>
                        <input class="form-control" type="number" name="pay" value="{{ old('pay', $data->pay) }}"  id="pay">
                        @error('pay')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <h4>Others Information</h4>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="driver" class="form-control-label">Driver</label>
                            <input class="form-control" name="driver" value="{{ old('driver', $data->driver) }}" type="text" placeholder="Driver Name" id="driver">
                            @error('driver')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="conductor" class="form-control-label">Conductor</label>
                            <input class="form-control" name="conductor" value="{{ old('conductor', $data->conductor) }}" type="text" placeholder="Conductor Name" id="driver">
                            @error('conductor')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="vehicle_name" class="form-control-label">Vehicle</label>
                            <input class="form-control" type="text" name="vehicle_name" value="{{ old('vehicle_name', $data->vehicle_name) }}" placeholder="Vehicle Name" id="vehicle_name">
                            @error('vehicle_name')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="vehicle_number" class="form-control-label">Vehicle Number</label>
                            <input class="form-control" type="text" name="vehicle_number" value="{{ old('vehicle_number', $data->vehicle_number) }}" placeholder="Vehicle Number"  id="vehicle_number">
                            @error('vehicle_number')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-control-label">Location</label>
                            <input class="form-control" type="text" name="location" value="{{ old('location', $data->location) }}" placeholder="Deliver Location"  id="location">
                            @error('location')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="submit" value="Save Order" class="btn btn-success">
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  <script>
    totalRate();
    function totalRate() {
        let commercial = $("#commercial").val();
        let commercial_rate = $("#commercial_rate").val();
        let commercial_discount = $("#commercial_discount").val();

        let domestic = $("#domestic").val();
        let domestic_rate = $("#domestic_rate").val();
        let domestic_discount = $("#domestic_discount").val();
        
        let domestic6 = $("#domestic6").val();
        let domestic6_rate = $("#domestic6_rate").val();
        let domestic6_discount = $("#domestic6_discount").val();


        // commercial
        commercial = commercial == '' ? 0 : FloatInDigits(commercial, 2)
        commercial_rate = commercial_rate == '' ? 0 : FloatInDigits(commercial_rate, 2)
        commercial_discount = commercial_discount == '' ? 0 : FloatInDigits(commercial_discount, 2);
        let total_comm_rate = FloatInDigits(commercial * commercial_rate, 2);
        let total_comm_disc = FloatInDigits(commercial * commercial_discount, 2);
        let dis_comm_rate = parseFloat(total_comm_rate - total_comm_disc);
        $("#txt_comm").html(total_comm_rate)
        $("#txt_dcomm").html(dis_comm_rate)
        
        //domestic (11.8)
        domestic = domestic == '' ? 0 : FloatInDigits(domestic, 2);
        domestic_rate = domestic_rate == '' ? 0 : FloatInDigits(domestic_rate, 2);
        domestic_discount = domestic_discount == '' ? 0 : FloatInDigits(domestic_discount, 2);
        let total_dom_rate = FloatInDigits(domestic * domestic_rate, 2);
        let total_dom_disc = FloatInDigits(domestic * domestic_discount, 2);
        let dis_dom_rate = parseFloat(total_dom_rate - total_dom_disc);
        $("#txt_dom").html(total_dom_rate)
        $("#txt_ddom").html(dis_dom_rate)
        
        //domestic (6)
        domestic6 = domestic6 == '' ? 0 : FloatInDigits(domestic6, 2);
        domestic6_rate = domestic6_rate == '' ? 0 : FloatInDigits(domestic6_rate, 2);
        domestic6_discount = domestic6_discount == '' ? 0 : FloatInDigits(domestic6_discount, 2);
        let total_dom6_rate = FloatInDigits(domestic6 * domestic6_rate, 2);
        let total_dom6_disc = FloatInDigits(domestic6 * domestic6_discount, 2);
        let dis_dom6_rate = parseFloat(total_dom6_rate - total_dom6_disc);
        $("#txt_dom6").html(total_dom6_rate)
        $("#txt_ddom6").html(dis_dom6_rate)
        
        let total_rate = FloatInDigits(total_comm_rate + total_dom_rate + total_dom6_rate, 2);
        let total_discount = FloatInDigits(total_comm_disc + total_dom_disc + total_dom6_disc, 2);
        let amount_after_discount = FloatInDigits(dis_comm_rate + dis_dom_rate + dis_dom6_rate, 2);
        $("#txt_total").html(total_rate);
        $("#txt_dis").html(total_discount);
        $("#txt_dtotal").html(amount_after_discount);
    }

    $("#commercial").on("keyup", function(){totalRate()})
    $("#commercial_discount").on("keyup", function(){totalRate()})
    $("#domestic").on("keyup", function(){totalRate()})
    $("#domestic_discount").on("keyup", function(){totalRate()})
    $("#domestic6").on("keyup", function(){totalRate()})
    $("#domestic6_discount").on("keyup", function(){totalRate()})
    $("#domestic10").on("keyup", function(){totalRate()})

  </script>
  @endsection