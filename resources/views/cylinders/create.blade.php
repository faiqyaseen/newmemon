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
                <h6>Add Cylinder</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cylinders.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Commercial(45.4) Cylinders Entry</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="commercial" class="form-control-label">Quantity</label>
                                <input class="form-control" name="commercial" value="{{ old('commercial') }}" type="number" placeholder="Commercial Cylinders" id="commercial">
                                @error('commercial')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="commercial_date" class="form-control-label">Date Of Purchased</label>
                                <input class="form-control" type="date" name="commercial_date" value="{{ old('commercial_date', date('Y-m-d')) }}" id="commercial_date" onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('commercial_date')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="commercial_price" class="form-control-label">Buy Price In pkr</label>
                                <input class="form-control" type="number" name="commercial_price" value="{{ old('commercial_price') }}" id="commercial_price">
                                @error('commercial_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Domestic(11.8) Cylinders Entry</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="domestic" class="form-control-label">Quantity</label>
                                <input class="form-control" name="domestic" value="{{ old('domestic') }}" type="number" placeholder="Domestic Cylinders" id="domestic">
                                @error('domestic')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="domestic_date" class="form-control-label">Date Of Purchased</label>
                                <input class="form-control" type="date" name="domestic_date" value="{{ old('domestic_date', date('Y-m-d')) }}" id="domestic_date" onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('domestic_date')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="domestic_price" class="form-control-label">Buy Price In pkr</label>
                                <input class="form-control" type="number" name="domestic_price" value="{{ old('domestic_price') }}" id="domestic_price">
                                @error('domestic_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Domestic(6) Cylinders Entry</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="domestic6" class="form-control-label">Quantity</label>
                                <input class="form-control" name="domestic6" value="{{ old('domestic6') }}" type="number" placeholder="Domestic(6) Cylinders" id="domestic6">
                                @error('domestic6')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="domestic6_date" class="form-control-label">Date Of Purchased</label>
                                <input class="form-control" type="date" name="domestic6_date" value="{{ old('domestic6_date', date('Y-m-d')) }}" id="domestic6_date" onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('domestic6_date')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="domestic6_price" class="form-control-label">Buy Price In pkr</label>
                                <input class="form-control" type="number" name="domestic6_price" value="{{ old('domestic6_price') }}" id="domestic6_price">
                                @error('domestic6_price')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                        <h6>Domestic(10) Cylinders Entry</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="domestic10" class="form-control-label">Quantity</label>
                                <input class="form-control" name="domestic10" value="{{ old('domestic10') }}" type="number" placeholder="Domestic(10) Cylinders" id="domestic10">
                                @error('domestic10')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="domestic10_date" class="form-control-label">Date Of Purchased</label>
                                <input class="form-control" type="date" name="domestic10_date" value="{{ old('domestic10_date', date('Y-m-d')) }}" id="domestic10_date" onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('domestic10_date')
                                <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="domestic10_price" class="form-control-label">Buy Price In pkr</label>
                                <input class="form-control" type="number" name="domestic10_price" value="{{ old('domestic10_price') }}" id="domestic10_price">
                                @error('domestic10_price')
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