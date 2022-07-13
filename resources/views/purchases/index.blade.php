@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('purchases.create') }}" class="btn btn-icon btn-3 btn-primary float-end" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                <span class="btn-inner--text">Add</span>
                </a>
                <h6>Purchase Record</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-secondary opacity-7"></th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Id</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Company</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Total Kgs</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Commercial Cylinders (45.4)</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Domestic Cylinders (11.8)</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Domestic Cylinders (6)</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Domestic Cylinders (10)</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Others Kg</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Rate Per Kg</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Total Rate</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Purchase Date</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Created At</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($records[0]))
                            <tr>
                                <td class="text-center" colspan="8">No Record Found...!</td>
                            <tr>
                                @else
                                @foreach ($records as $record)
                            <tr>
                                <td class="align-middle">
                                    <a href="{{ route('purchases.show', $record->id) }}" class="text-primary font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Show">
                                    <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('purchases.edit', $record->id) }}" class="text-warning font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="javascript:;" onclick="deleteFunction({{ $record->id }})" class="text-danger font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="deleteForm{{ $record->id }}" method="POST" action="{{ route('purchases.destroy', $record->id) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->id }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->company_name }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->kg }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ explode(';', $record->remarks)[0] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span id="myvalueeeee" class="text-secondary text-xs font-weight-bold">{{ explode(';', $record->remarks)[1] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ explode(';', $record->remarks)[2] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ explode(';', $record->remarks)[3] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ explode(';', $record->remarks)[4] }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->rate }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $record->total_rate }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ dateToString( $record->sale_purchase_date) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ dateForHumans($record->created_at) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ dateForHumans($record->updated_at) }}</span>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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