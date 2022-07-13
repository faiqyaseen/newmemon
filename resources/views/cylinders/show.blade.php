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
            <h6>Sell Details Of Cylinders</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="row py-0 my-0">
                <div class="col-sm-2 text-center">
                    <h5>Name</h5>
                </div>
                <div class="col-sm-10">
                    <div class="col-sm-2">
                        
                    </div>
                </div>
            </div>
            <hr>
            @foreach ($ids as $key => $id)  
            <dl class="row p-4">
                <dt class="col-sm-2">{{ $first_names[$key] }} {{ $last_names[$key] }}</dt>
                <dd class="col-sm-10">
                    @foreach ($records as $record)
                    @if ($record->customers_id == $id)
                    <dl class="row">
                        <dd class="col-sm-2">{{ $record->cyl_type }}</dd>
                        <dd class="col-sm-2">{{ $record->wall_type }}</dd>
                        <dd class="col-sm-2">{{ $record->sell_date }}</dd>
                        <dd class="col-sm-2">{{ $record->buy_price }}</dd>
                        <dd class="col-sm-2">{{ $record->sell_price }}</dd>
                    </dl>
                    @endif
                    @endforeach
                </dd>
            </dl>
            <hr>
            @endforeach
        </div>
      </div>
    </div>
  </div>
  @endsection