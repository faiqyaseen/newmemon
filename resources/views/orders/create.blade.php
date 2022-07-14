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
          <h6>Add Order</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="customer_id" class="form-control-label">Customer</label>
                    <select name="customer_id" class="form-control" id="customer_id">
                        <option value="" disabled selected>Select Customer</option>
                        @foreach ($customers as $customer)
                        @if (old('customer_id') == $customer->id)
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
                    <label for="today_rate" class="form-control-label">Rate Per Kg</label>
                    <input class="form-control" name="today_rate" value="{{ old('today_rate') }}" type="number" placeholder="Rate Per Kg" id="today_rate">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="commercial" class="form-control-label">Commercial Cylinder(45.4Kg)</label>
                            <input class="form-control" name="commercial" value="{{ old('commercial') }}" type="number" placeholder="Commercial Cylinders" id="commercial">
                            @error('commercial')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="commercial_rate" class="form-control-label">Commercial Cylinder Rate</label>
                            <input class="form-control" type="number" readonly name="commercial_rate" value="{{ old('commercial_rate') }}" id="commercial_rate">
                            @error('commercial_rate')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="commercial_discount" class="form-control-label">Discount On Commercial Cylinder</label>
                            <input class="form-control" type="number" name="commercial_discount" value="{{ old('commercial_discount') }}"  id="commercial_discount">
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
                            <input class="form-control" name="domestic" value="{{ old('domestic') }}" type="number" placeholder="Domestic Cylinders" id="domestic">
                            @error('domestic')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic_rate" class="form-control-label">Domestic Cylinder Rate</label>
                            <input class="form-control" type="number" readonly name="domestic_rate" value="{{ old('domestic_rate') }}" id="domestic_rate">
                            @error('domestic_rate')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic_discount" class="form-control-label">Discount On Domestic Cylinder</label>
                            <input class="form-control" type="number" name="domestic_discount" value="{{ old('domestic_discount') }}"  id="domestic_discount">
                            @error('domestic_discount')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <p>Total Domestic (11.8) Rate: <b id="txt_dom"></b></p>
                            <p>After Discount Domestic (11.8) Rate: <b id="txt_ddom"></b></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="domestic6" class="form-control-label">Domestic Cylinder(6Kg)</label>
                            <input class="form-control" name="domestic6" value="{{ old('domestic6') }}" type="number" placeholder="Domestic Cylinders (6Kg)" id="domestic6">
                            @error('domestic6')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic6_rate" class="form-control-label">Domestic (6Kg) Rate</label>
                            <input class="form-control" type="number" readonly name="domestic6_rate" value="{{ old('domestic6_rate') }}" id="domestic6_rate">
                            @error('domestic6_rate')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="domestic6_discount" class="form-control-label">Discount On Domestic Cylinder (6kg)</label>
                            <input class="form-control" type="number" name="domestic6_discount" value="{{ old('domestic6_discount') }}"  id="domestic6_discount">
                            @error('domestic6_discount')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <p>Total Domestic (6) Rate: <b id="txt_dom6"></b></p>
                            <p>After Discount Domestic (6) Rate: <b id="txt_ddom6"></b></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="">Total Rate:<span id="txt_total"></span></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="">Total Discount:<b id="txt_dis"></b></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="">After Discount Rate:<b id="txt_dtotal"></b></h6>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="pay" class="form-control-label">Pay</label>
                        <input class="form-control" type="number" name="pay" value="{{ old('pay') }}"  id="pay">
                        @error('pay')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="">Remaining Amount: <b id="remaining"></b></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="">Total With Remainings Amount: <b id="tremaining"></b></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 class="">After Payment Remainings: <b id="pay_remaining"></b></h6>
                    </div>
                </div>
                <h4>Others Information</h4>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="remarks" class="form-control-label">Remarks</label>
                        <input class="form-control" type="text" name="remarks" value="{{ old('remarks') }}"  id="remarks">
                        @error('remarks')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="driver" class="form-control-label">Driver</label>
                            <input class="form-control" name="driver" value="{{ old('driver') }}" type="text" placeholder="Driver Name" id="driver">
                            @error('driver')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="conductor" class="form-control-label">Conductor</label>
                            <input class="form-control" name="conductor" value="{{ old('conductor') }}" type="text" placeholder="Conductor Name" id="driver">
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
                            <input class="form-control" type="text" name="vehicle_name" value="{{ old('vehicle_name') }}" placeholder="Vehicle Name" id="vehicle_name">
                            @error('vehicle_name')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="vehicle_number" class="form-control-label">Vehicle Number</label>
                            <input class="form-control" type="text" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="Vehicle Number"  id="vehicle_number">
                            @error('vehicle_number')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-control-label">Location</label>
                            <input class="form-control" type="text" name="location" value="{{ old('location') }}" placeholder="Deliver Location"  id="location">
                            @error('location')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <h6>Note: <span class="text-danger">This will create only pending orders. You have to confirm orders from order page.</span> </h6>
                <input type="submit" value="Create Order" class="btn btn-success">
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  <script>
    let remainings = 0;
    $("#customer_id").on('change', function () {
        let customer_id = $("#customer_id").val();
        $.ajax({
            type: "GET",
            url: "{{ route('orders.remainings') }}",
            data: {
                customer_id:customer_id
            },
            error: function (response) {
                console.log(response);
            },
            success: function (response) {
                remainings = response;
                let amount_after_discount = $("#txt_dtotal").val();
                amount_after_discount = amount_after_discount == '' ? 0 : FloatInDigits(amount_after_discount, 2);
                $("#remaining").html(response + amount_after_discount)
            }
        });
    })
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

        let pay = $("#pay").val();
        pay = pay == '' ? 0 : FloatInDigits(pay, 2)
        let tremaining = remainings + amount_after_discount;
        $("#tremaining").html(tremaining)
        let pay_remaining = (tremaining - pay < 0 ? 0 : tremaining - pay);
        $("#pay_remaining").html(pay_remaining)
    }

    // $("#commercial").on("keyup", function(){totalRate()})
    // $("#commercial_discount").on("keyup", function(){totalRate()})
    // $("#domestic").on("keyup", function(){totalRate()})
    // $("#domestic_discount").on("keyup", function(){totalRate()})
    // $("#domestic6").on("keyup", function(){totalRate()})
    // $("#domestic6_discount").on("keyup", function(){totalRate()})
    // $("#domestic10").on("keyup", function(){totalRate()})
    // $("#domestic10_discount").on("keyup", function(){totalRate()})
    // $("#pay").on("keyup", function(){totalRate()})

    $("body").on('keyup',
        `#commercial,
        #commercial_discount,
        #domestic,
        #domestic_discount,
        #domestic6,
        #domestic6_discount,
        #domestic10,
        #domestic10_discount,
        #pay`, function () {
            totalRate();
        }
    )

    $("#today_rate").on("keyup", function () {
        let today_rate = $("#today_rate").val()
        today_rate = today_rate == '' ? 0 : FloatInDigits(today_rate, 2);
        let commercial_rate = FloatInDigits(today_rate * 45.4, 2);
        let domestic_rate = FloatInDigits(today_rate * 11.8, 2);
        let domestic6_rate = FloatInDigits(today_rate * 6, 2);
        $("#commercial_rate").val(commercial_rate);
        $("#domestic_rate").val(domestic_rate);
        $("#domestic6_rate").val(domestic6_rate);
    })
  </script>
  @endsection