@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('orders.create') }}" class="btn btn-icon btn-3 btn-primary float-end" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                <span class="btn-inner--text">Add</span>
                </a>
                <h6>Empties At Customers</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-secondary opacity-7"></th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">#</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Customer Name</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Customer Email</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Total Empties</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Commercial (45.4kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Domestic (11.8kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Domestic (6kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Domestic (10kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Last Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $record)
                            <tr>
                                <td class="align-middle">
                                    {{-- @if ($record->status != 1)
                                    <a href="javascript:;" onclick="confirmFunction({{ $record->order_id }})" class="text-primary font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm Order">
                                    <i class="fas fa-solid fa-check"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('orders.show', $record->order_id) }}" class="text-primary font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Show Order">
                                    <i class="fas fa-eye"></i>
                                    </a>
                                    @if ($record->status != 3)
                                    <a href="javascript:;" onclick="deleteFunction({{ $record->order_id }})" class="text-danger font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Order">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                    @endif
                                    <form id="confirmForm{{ $record->order_id }}" method="POST" action="{{ route('orders.confirm', $record->order_id) }}">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <form id="deleteForm{{ $record->order_id  }}" method="POST" action="{{ route('orders.destroy', $record->order_id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $key + 1 }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->customer_first_name }} {{ $record->customer_last_name}}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->customer_email }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->total_empties }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->commercial_empties }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->domestic_empties }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->domestic6_empties }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->domestic10_empties }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ dateForHumans($record->last_activity) }}</span>
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
      $("#deleteForm"+id).submit();
    }
    
    function confirmFunction(id) {
      $("#confirmForm"+id).submit();
    }
</script>
@endsection