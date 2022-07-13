@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('payments.create') }}" class="btn btn-icon btn-3 btn-primary float-end" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
              <span class="btn-inner--text">Create Payment</span>
            </a>
          <h6>Customers Payment</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-secondary opacity-7"></th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">#</th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">Customer Name</th>
                  <th class="text-uppercase bg-danger text-center text-xs font-weight-bolder ps-2">Remainings</th>
                  <th class="text-uppercase bg-warning text-center text-xs font-weight-bolder ps-2">Extra</th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">Total Orders</th>
                  <th class="text-uppercase text-xs bg-success text-center font-weight-bolder">Total paid</th>
                  <th class="text-uppercase text-secondary text-center text-xs font-weight-bolder">Total Amount From Fix Date</th>
                  <th class="text-center text-uppercase text-secondary text-center text-xxs font-weight-bolder">Last Updated</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($records as $key => $record)
                  <tr>
                    <td class="align-middle text-center">
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
                      <span class="text-secondary text-xs font-weight-bold">{{ $key+1 }}</span>
                    </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record['first_name'] }} {{ $record['last_name'] }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-danger text-xs font-weight-bold">{{ $record['remaining'] > 0 ? $record['remaining'] : 0 }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-warning text-xs font-weight-bold">{{ $record['remaining'] < 0 ? abs($record['remaining']) : 0 }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record['total_orders'] }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-success text-xs font-weight-bold">{{ $record['total_paid'] }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $record['total_amount'] }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::createFromTimeStamp(strtotime($record['updated_at']))->toDateString() }}</span>
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