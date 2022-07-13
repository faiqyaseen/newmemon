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
            <h6>Details</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <dl class="row p-4">
                <dt class="col-sm-3">Id</dt>
                <dd class="col-sm-9">{{ $data->id }}</dd>
                <hr>
                <dt class="col-sm-3">Total Kgs</dt>
                <dd class="col-sm-9">{{ $data->kg }}</dd>
                <hr>
                <dt class="col-sm-3">Commercial Cylinders(45.4)</dt>
                <dd class="col-sm-9">{{ explode(';', $data->remarks)[0] }}</dd>
                <hr>
                <dt class="col-sm-3">Domestic Cylinders(11.8)</dt>
                <dd class="col-sm-9">{{ explode(';', $data->remarks)[1] }}</dd>
                <hr>
                <dt class="col-sm-3">Domestic Cylinders(6)</dt>
                <dd class="col-sm-9">{{ explode(';', $data->remarks)[2] }}</dd>
                <hr>
                <dt class="col-sm-3">Domestic Cylinders(10)</dt>
                <dd class="col-sm-9">{{ explode(';', $data->remarks)[3] }}</dd>
                <hr>
                <dt class="col-sm-3">Other kgs</dt>
                <dd class="col-sm-9">{{ explode(';', $data->remarks)[4] }}</dd>
                <hr>
                <dt class="col-sm-3">Rate Per Kg</dt>
                <dd class="col-sm-9">{{ $data->rate }}</dd>
                <hr>
                <dt class="col-sm-3">Total Rate</dt>
                <dd class="col-sm-9">{{ $data->total_rate }}</dd>
                <hr>
                <dt class="col-sm-3">In Date</dt>
                <dd class="col-sm-9">{{ $data->in_out_date }}</dd>
                <hr>
                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $data->created_at }}</dd>
                <hr>
                <dt class="col-sm-3">Updated At</dt>
                <dd class="col-sm-9">{{ $data->updated_at }}</dd>
              </dl>
        </div>
      </div>
    </div>
</div>
@endsection