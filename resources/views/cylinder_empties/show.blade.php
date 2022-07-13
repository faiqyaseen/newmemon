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
            <h6>Order Details</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <dl class="row p-4">
                <dt class="col-sm-3">Customer Name</dt>
                <dd class="col-sm-9"><a href="{{ route('customers.show', $data->customer_id) }}">{{ Str::ucfirst($data->customer_first_name) }} {{ Str::ucfirst($data->customer_last_name) }}</a></dd>
                <hr>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9"><?php if ($data->order_status == 1) { echo 'APPROVED'; } else if($data->order_status == 2) { echo 'PENDING'; } else { echo 'CANCELLED'; } ?></dd>
                <hr>
                <dt class="col-sm-3">Total Products</dt>
                <dd class="col-sm-9">{{ $data->total_products }}</dd>
                <hr>
                <dt class="col-sm-3">Commercial (45.4kg) Cylinders</dt>
                <dd class="col-sm-9">{{ $data->commercial_cylinders }}</dd>
                <hr>
                <dt class="col-sm-3">Domestic (11.8kg) Cylinders</dt>
                <dd class="col-sm-9">{{ $data->domestic_cylinders }}</dd>
                <hr>
                <dt class="col-sm-3">Domestic (6kg) Cylinders</dt>
                <dd class="col-sm-9">{{ $data->domestic6_cylinders }}</dd>
                <hr>
                <dt class="col-sm-3">Total Amount</dt>
                <dd class="col-sm-9">{{ $data->order_amount }}</dd>
                <hr>
                <dt class="col-sm-3">Total Discount</dt>
                <dd class="col-sm-9">{{ $data->order_discount }}</dd>
                <hr>
                <dt class="col-sm-3">Amount After Discount</dt>
                <dd class="col-sm-9">{{ $data->order_discount_amount }}</dd>
                <hr>
                <dt class="col-sm-3">Remarks</dt>
                <dd class="col-sm-9">{{ $data->order_remarks }}</dd>
                <hr>
                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $data->order_created_at }} || {{ Carbon\Carbon::createFromTimeStamp(strtotime($data->order_created_at))->diffForHumans() }}</dd>
                <hr>
                <dt class="col-sm-3">Last Update</dt>
                <dd class="col-sm-9">{{ $data->order_updated_at }} || {{ Carbon\Carbon::createFromTimeStamp(strtotime($data->order_updated_at))->diffForHumans() }}</dd>
                <hr>
              </dl>
        </div>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <h6 class="float-start">Order #{{ $data->order_id }} Products</h6>
            <a href="{{ route('orders.edit', $data->order_id) }}" class="btn btn-sm btn-warning float-end">Manage Products</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder">Cylinder Type</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2">Amount</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder">Discount</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder">Amount After Discount</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $record)
                      <tr>
                        <td class="align-middle text-center">
                          {{-- <a href="{{ route('orders_products.show', $record->id) }}" class="text-primary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Show Order Product">
                              <i class="fas fa-eye"></i>
                          </a> --}}
                          <a href="{{ route('orders_products.edit', $record->id) }}" class="text-warning font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Edit Order Product">
                              <i class="fas fa-pen"></i>
                          </a>
                          <a href="javascript:;" onclick="deleteFunction({{ $record->id }})" class="text-danger font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Delete Order Product">
                              <i class="fas fa-trash"></i>
                          </a>
                          <form id="deleteForm{{ $record->id }}" method="POST" action="{{ route('orders_products.destroy', $record->id) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold"><?php if ($record->cylinder_type == 1) {echo 'Commercial (45.4kg)';} else if ($record->cylinder_type == 2) {echo 'Domestic (11.8kg)';} else if ($record->cylinder_type == 3) {echo 'Domestic (6kg)';} ?></span>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{ $record->price }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{ $record->discount }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-secondary text-xs font-weight-bold">{{ $record->amount_after_discount }}</span>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>
</div>
<script>
    function deleteFunction(id) {
      document.getElementById("deleteForm"+id).submit();
    }
  </script>
@endsection