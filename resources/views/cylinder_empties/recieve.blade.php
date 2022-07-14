@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('empties.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
          <h6>Recieve Empties</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('empties.recieved') }}" method="POST">
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
                    </div>
                </div>
                <input type="submit" value="Recieve Empties" class="btn btn-success">
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  @endsection