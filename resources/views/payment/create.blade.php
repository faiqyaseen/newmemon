@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('users.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
          <h6>Create Customer Payments</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="customer_id" class="form-control-label">Customer</label>
                    <select name="customer_id" class="form-control" id="customer_id">
                        <option value="" disabled selected>Select Customer</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="payment" class="form-control-label">Payment</label>
                        <input class="form-control" value="{{ old('payment') }}" type="number" name="payment" value="{{ old('payment') }}"  id="payment">
                        @error('payment')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="payment_date" class="form-control-label">Date Of Payment</label>
                        <input class="form-control" type="date" name="payment_date" value="{{ date('Y-m-d') }}" id="payment_date" onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('payment_date')
                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <input type="submit" value="Save" class="btn btn-success">
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection