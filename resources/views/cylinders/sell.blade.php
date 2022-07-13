@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('cylinders.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                </a>
                <h6 class="text-success font-weight-bolder">SELL CYLINDERS</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cylinders.sell') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="to_id" class="form-control-label">Sell To</label>
                        <select name="to_id" id="to_id" class="form-control">
                            <option value="" disabled selected>Select Customer</option>
                            @foreach ($customers as $customer)
                            @if ($customer->id == old('to_id'))
                            <option value="{{ $customer->id }}" selected>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @else
                            <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('to_id')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_of_sell" class="form-control-label">Date Of Sell</label>
                        <input class="form-control" type="date" name="date_of_sell" value="{{ date('Y-m-d') }}" id="date_of_sell" onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('date_of_sell')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Commercial (45.4kg) Cylinders</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="commercial" class="form-control-label">Quantity</label>
                                <input class="form-control" name="commercial" value="{{ old('commercial') }}" type="number" placeholder="Commercial Cylinders" id="commercial">
                                @error('commercial')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="commercial_price" class="form-control-label">Price Per Cylinder</label>
                                <input class="form-control" name="commercial_price" value="{{ old('commercial_price') }}" type="number" placeholder="Price Per Cylinder" id="commercial_price">
                                @error('commercial_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 pt-2">
                                <p class="float-end">Total Commercial Price: <span id="ctotal"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Domestic (11.8kg) Cylinders</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="domestic" class="form-control-label">Quantity</label>
                                <input class="form-control" name="domestic" value="{{ old('domestic') }}" type="number" placeholder="Number Of Cylinders" id="domestic">
                                @error('domestic')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="domestic_price" class="form-control-label">Price Per Cylinder</label>
                                <input class="form-control" name="domestic_price" value="{{ old('domestic_price') }}" type="number" placeholder="Price Per Cylinder" id="domestic_price">
                                @error('domestic_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 pt-2">
                                <p class="float-end">Total Domestic (11.8kg) Price: <span id="dtotal"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Domestic (6kg) Cylinders</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="domestic6" class="form-control-label">Quantity</label>
                                <input class="form-control" name="domestic6" value="{{ old('domestic6') }}" type="number" placeholder="Domestic (6kg) Cylinders" id="domestic6">
                                @error('domestic6')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="domestic6_price" class="form-control-label">Price Per Cylinder</label>
                                <input class="form-control" name="domestic6_price" value="{{ old('domestic6_price') }}" type="number" placeholder="Price Per Cylinder" id="domestic6_price">
                                @error('domestic6_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 pt-2">
                                <p class="float-end">Total Domestic (6kg) Price: <span id="d6total"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Domestic (10kg) Cylinders</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="domestic10" class="form-control-label">Quantity</label>
                                <input class="form-control" name="domestic10" value="{{ old('domestic10') }}" type="number" placeholder="Domestic (10kg) Cylinders" id="domestic10">
                                @error('domestic10')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="domestic10_price" class="form-control-label">Price Per Cylinder</label>
                                <input class="form-control" name="domestic10_price" value="{{ old('domestic10_price') }}" type="number" placeholder="Price Per Cylinder" id="domestic10_price">
                                @error('domestic10_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 pt-2">
                                <p class="float-end">Total Domestic (10kg) Price: <span id="d10total"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 pt-2">
                        <p class="float-end">TotalPrice: <span id="total"></span></p>
                    </div>
                    <input type="submit" value="Sell" class="btn btn-primary">
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
            let domestic = $("#domestic").val();
            let domestic6 = $("#domestic6").val();
            let domestic10 = $("#domestic10").val();

            let commercial_price = $("#commercial_price").val();
            let domestic_price = $("#domestic_price").val();
            let domestic6_price = $("#domestic6_price").val();
            let domestic10_price = $("#domestic10_price").val();

            commercial = commercial == '' ? 0 : FloatInDigits(commercial, 0);
            domestic = domestic == '' ? 0 : FloatInDigits(domestic, 0);
            domestic6 = domestic6 == '' ? 0 : FloatInDigits(domestic6, 0);
            domestic10 = domestic10 == '' ? 0 : FloatInDigits(domestic10, 0);

            commercial_price = commercial_price == '' ? 0 : FloatInDigits(commercial_price, 2);
            domestic_price = domestic_price == '' ? 0 : FloatInDigits(domestic_price, 2);
            domestic6_price = domestic6_price == '' ? 0 : FloatInDigits(domestic6_price, 2);
            domestic10_price = domestic10_price == '' ? 0 : FloatInDigits(domestic10_price, 2);

            let total_commercial = FloatInDigits(commercial * commercial_price, 2);
            let total_domestic = FloatInDigits(domestic * domestic_price, 2);
            let total_domestic6 = FloatInDigits(domestic6 * domestic6_price, 2);
            let total_domestic10 = FloatInDigits(domestic10 * domestic10_price, 2);
            let total = FloatInDigits(total_commercial + total_domestic + total_domestic6 + total_domestic10, 2);
            $("#ctotal").html(total_commercial);
            $("#dtotal").html(total_domestic);
            $("#d6total").html(total_domestic6);
            $("#d10total").html(total_domestic10);
            $("#total").html(total);
        }

        $(document).ready(function () {
            $('#to_id').select2();
            $("body").on('keyup',
            `#commercial,
            #commercial_price,
            #domestic,
            #domestic_price,
            #domestic6,
            #domestic6_price,
            #domestic10,
            #domestic10_price`, function () {
                totalRate();
            })
        });
    </script>
@endsection