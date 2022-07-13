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
                <h6>All Orders</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-secondary opacity-7"></th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">#</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Customer Name</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Total Products</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Commercial (45.4kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Domestic (11.8kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Domestic (6kg)</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Total Amount</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Total Discount</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Amount After Discount</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Paid At Delivery Time</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Remarks</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                            <tr>
                                <td class="align-middle">
                                    @if ($record->status != 1)
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
                                    </form>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->order_id }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->customer_first_name }} {{ $record->customer_last_name}}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-<?php if ($record->order_status == 1) { echo 'success'; } else if ($record->order_status == 2) { echo 'warning'; } else { echo 'danger'; } ?>"><?php if ($record->order_status == 1) { echo 'APPROVED'; } else if($record->order_status == 2) { echo 'PENDING'; } else { echo 'CANCELLED'; } ?></span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->total_products }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->commercial_cylinders }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->domestic_cylinders }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->domestic6_cylinders }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->order_amount }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->order_discount }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->order_discount_amount }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->pay }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->order_remarks }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::createFromTimeStamp(strtotime($record->order_created_at))->toDateString() }}</span>
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