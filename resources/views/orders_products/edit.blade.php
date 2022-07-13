@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ url()->previous() }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
          <h6>Edit Product Of Order # {{ $data->order_id }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('orders_products.update', $data->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="cylinder_type" class="form-control-label">Select Cylinder Type</label>
                    <select name="cylinder_type" id="cylinder_type" class="form-control">
                        <option value="" disabled>Select Type</option>
                        @foreach (selectCylinderType() as $key => $type)
                        @if (old('cylinder_type', $key) == $data->cylinder_type)
                        <option value="{{ $key }}" selected>{{ $type }}</option>
                        @else
                        <option value="{{ $key }}">{{ $type }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('cylinder_type')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price" class="form-control-label">Amount</label>
                    <input class="form-control" name="price" value="{{ old('price', $data->price) }}" type="number" placeholder="Price" id="price">
                    @error('price')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="discount" class="form-control-label">Discount</label>
                    <input class="form-control" name="discount" value="{{ old('discount', $data->discount) }}" type="number" placeholder="Discount" id="discount">
                    @error('discount')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Update" class="btn btn-success float-end">
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection