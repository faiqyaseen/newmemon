@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('purchases.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
          <h6>Purchase</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('purchases.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="company_id" class="form-control-label">Company</label>
                    <select name="company_id" class="form-control" id="company_id">
                        <option value="" disabled selected>Select Company</option>
                        @foreach ($companies as $company)
                        @if (old('customer_id') == $company->id)
                        <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                        @else
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('company_id')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="commercial" class="form-control-label">Commercial Cylinder(45.4Kg)</label>
                        <input class="form-control" name="commercial" value="{{ old('commercial') }}" type="number" placeholder="Commercial Cylinders" id="commercial">
                        @error('commercial')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="domestic" class="form-control-label">Domestic Cylinder(11.8Kg)</label>
                        <input class="form-control" name="domestic" value="{{ old('domestic') }}" type="number" placeholder="Domestic Cylinders" id="domestic">
                        @error('domestic')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="domestic6" class="form-control-label">Domestic Cylinder(6Kg)</label>
                        <input class="form-control" name="domestic6" value="{{ old('domestic6') }}" type="number" placeholder="Domestic Cylinders (6Kg)" id="domestic6">
                        @error('domestic6')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="domestic10" class="form-control-label">Domestic Cylinder(10Kg)</label>
                        <input class="form-control" name="domestic10" value="{{ old('domestic10') }}" type="number" placeholder="Domestic Cylinders (10Kg)" id="domestic10">
                        @error('domestic10')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="others" class="form-control-label">Others Kg</label>
                                <input class="form-control" type="number" placeholder="Others Kg" name="others" value="{{ old('others') }}"  id="others">
                                @error('others')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="rate" class="form-control-label">Rate Per Kg</label>
                                <input class="form-control" placeholder="Rate Per Kg" type="number" name="rate" value="{{ old('rate') }}"  id="rate">
                                @error('rate')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="date" class="form-control-label">Date</label>
                            <input class="form-control" type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" id="date" onfocus="focused(this)" onfocusout="defocused(this)">
                            @error('date')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <h6>Total Gas: <span id="txt_total_gas"></span></h6>
                <h6>Total Rate: <span id="txt_total_rate"></span></h6>
                <h4>Others Information</h4>
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
                        <div class="col-md-6">
                            <label for="vehicle_name" class="form-control-label">Vehicle</label>
                            <input class="form-control" type="text" name="vehicle_name" value="{{ old('vehicle_name') }}" placeholder="Vehicle Name" id="vehicle_name">
                            @error('vehicle_name')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="vehicle_number" class="form-control-label">Vehicle Number</label>
                            <input class="form-control" type="text" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="Vehicle Number"  id="vehicle_number">
                            @error('vehicle_number')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="submit" value="Save" class="btn btn-success">
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  <script>
    totalRate()
    function totalRate() {
        let rate = $("#rate").val();
        let commercial = $("#commercial").val();
        let domestic = $("#domestic").val();
        let domestic6 = $("#domestic6").val();
        let domestic10 = $("#domestic10").val();
        let others = $("#others").val();
        let credit = $("#credit").val();

        rate = rate == '' ? 0 : FloatInDigits(rate);
        commercial = commercial == '' ? 0 : FloatInDigits(commercial * 45.4, 2);
        domestic = domestic == '' ? 0 : FloatInDigits(domestic * 11.8, 2);
        domestic6 = domestic6 == '' ? 0 : FloatInDigits(domestic6* 6, 2);
        domestic10 = domestic10 == '' ? 0 : FloatInDigits(domestic10 * 10, 2);
        others = others == '' ? 0 : FloatInDigits(others, 2);

        let totalgas = commercial + domestic + domestic6 + domestic10 + others;
        let total_rate = FloatInDigits(totalgas * rate, 2);
        $("#txt_total_gas").html(totalgas);
        $("#txt_total_rate").html(total_rate);
    }

    $("body").on("keyup",
        `#rate,
        #commercial,
        #domestic,
        #domestic6,
        #domestic10,
        #others,
        #credit`, function () {
            totalRate()
    })
  </script>
  @endsection