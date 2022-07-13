@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Payment Record Of {{ $customer->first_name }} {{ $customer->last_name }}</h6>
          <h6>Total Paid: <span class="text-success">{{ $total_paid }}</span></h6>
          <h6>Remainings: <span class="text-danger">{{$remaining > 0 ? $remaining : 0 }}</span></h6>
          <h6>Extras: <span class="text-warning">{{$remaining < 0 ? abs($remaining) : 0 }}</span></h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-secondary opacity-7"></th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">#</th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">Order #</th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">Payment Type</th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">Payemnt</th>
                  <th class="text-center text-uppercase text-secondary text-center text-xxs font-weight-bolder">Created At</th>
                  <th class="text-center text-uppercase text-secondary text-center text-xxs font-weight-bolder">Updated At</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($records as $key => $record)
                  <tr>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $key+1 }}</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{ route('payments.show', $record['customer_id']) }}" class="text-primary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Show order">
                          <i class="fas fa-eye"></i>
                      </a>
                      {{-- <a href="{{ route('orders.edit', $record->order_id) }}" class="text-warning font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Edit order">
                          <i class="fas fa-pen"></i>
                      </a>
                      <a href="javascript:;" onclick="deleteFunction({{ $record->order_id }})" class="text-danger font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Delete order">
                          <i class="fas fa-trash"></i>
                      </a>
                      <form id="deleteForm{{ $record->order_id }}" method="POST" action="{{ route('orders.destroy', $record->order_id) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                  </td> --}}
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record->order_id != 0 ? '#'.$record->order_id : 'Not a order' }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-danger text-xs font-weight-bold">{{ $record->order_type == 1 ? 'Cylinder Order' : 'Other' }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record->payment }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record->created_at->toDateString() }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record->updated_at->toDateString() }}</span>
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