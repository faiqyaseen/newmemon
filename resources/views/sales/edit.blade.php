@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('sales.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
          <h6>Update Sale Record</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('sales.update', $data->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="branch_id" class="form-control-label">Branch</label>
                    <select name="branch_id" class="form-control" id="branch_id">
                        <option value="" disabled selected>Select Branch</option>
                        @foreach ($branches as $branch)
                        @if (old('branch_id', $data->branch_id) == $branch->id)
                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                        @else
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('branch_id')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="commercial" class="form-control-label">Commercial Cylinder(45.4Kg)</label>
                        <input class="form-control" name="commercial" value="{{ old('commercial', explode(';', $data->remarks)[0]) }}" type="number" placeholder="Commercial Cylinders" id="commercial">
                        @error('commercial')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="domestic" class="form-control-label">Domestic Cylinder(11.8Kg)</label>
                        <input class="form-control" name="domestic" value="{{ old('domestic', explode(';', $data->remarks)[1]) }}" type="number" placeholder="Domestic Cylinders" id="domestic">
                        @error('domestic')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="domestic6" class="form-control-label">Domestic Cylinder(6Kg)</label>
                        <input class="form-control" name="domestic6" value="{{ old('domestic6', explode(';', $data->remarks)[2]) }}" type="number" placeholder="Domestic Cylinders (6Kg)" id="domestic6">
                        @error('domestic6')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="domestic10" class="form-control-label">Domestic Cylinder(10Kg)</label>
                        <input class="form-control" name="domestic10" value="{{ old('domestic10', explode(';', $data->remarks)[2]) }}" type="number" placeholder="Domestic Cylinders (10Kg)" id="domestic10">
                        @error('domestic10')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="others" class="form-control-label">Others Kg</label>
                                <input class="form-control" type="number" placeholder="Others Kg" name="others" value="{{ old('others', explode(';', $data->remarks)[4]) }}"  id="others">
                                @error('others')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="rate" class="form-control-label">Rate Per Kg</label>
                                <input class="form-control" placeholder="Rate Per Kg" type="number" name="rate" value="{{ old('rate', $data->rate) }}"  id="rate">
                                @error('rate')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date" class="form-control-label">Date</label>
                                <input class="form-control" type="date" name="date" value="{{ old('date', $data->in_out_date) }}" id="date" onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('date')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="credit" class="form-control-label">Credit</label>
                                <input class="form-control" type="number" name="credit" value="{{ old('credit', $data->credit) }}" id="credit">
                                @error('credit')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <h6>Total Gas: <span id="txt_total_gas"></span></h6>
                <h6>Total Rate: <span id="txt_total_rate"></span></h6>
                <h6>Less: <span class="text-danger" id="txt_less"></span></h6>
                <input type="submit" value="Save" class="btn btn-success">
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
        let rate = $("#rate").val();
        let commercial = $("#commercial").val();
        let domestic = $("#domestic").val();
        let domestic6 = $("#domestic6").val();
        let domestic10 = $("#domestic10").val();
        let others = $("#others").val();
        let credit = $("#credit").val();

        rate = rate == '' ? 0 : FloatInDigits(rate, 2);
        credit = credit == '' ? 0 : FloatInDigits(credit, 2);
        commercial = commercial == '' ? 0 : FloatInDigits(commercial * 45.4, 2);
        domestic = domestic == '' ? 0 : FloatInDigits(domestic * 11.8, 2);
        domestic6 = domestic6 == '' ? 0 : FloatInDigits(domestic6 * 6, 2);
        domestic10 = domestic10 == '' ? 0 : FloatInDigits(domestic10 * 10, 2);
        others = others == '' ? 0 : FloatInDigits(others, 2);

        let totalgas = FloatInDigits(commercial + domestic + domestic6 + domestic10 + others, 2);
        let total_rate = FloatInDigits(totalgas * rate, 2);
        let less = FloatInDigits(total_rate - credit, 2);
        $("#txt_total_gas").html(totalgas);
        $("#txt_total_rate").html(total_rate);
        $("#txt_less").html(less);
    }

    $("#rate").on("keyup", function () {
        totalRate()
    })
    $("#commercial").on("keyup", function () {
        totalRate()
    })
    $("#domestic").on("keyup", function () {
        totalRate()
    })
    $("#domestic6").on("keyup", function () {
        totalRate()
    })
    $("#domestic10").on("keyup", function () {
        totalRate()
    })
    $("#others").on("keyup", function () {
        totalRate()
    })
    $("#credit").on("keyup", function () {
        totalRate()
    })
  </script>
  @endsection