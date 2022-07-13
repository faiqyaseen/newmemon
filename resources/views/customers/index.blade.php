@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('customers.create') }}" class="btn btn-icon btn-3 btn-primary float-end" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
              <span class="btn-inner--text">Add</span>
            </a>
          <h6>All Customers</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0" id="table">
              <thead>
                <tr>
                  <th class="text-secondary opacity-7"></th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">#</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Phone Number</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Cnic</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Address</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Is Owner</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Remarks</th>
                  {{-- <th class="text-uppercase text-secondary text-xs font-weight-bolder">Address</th> --}}
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Created At</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($records as $record)
                  <tr>
                    <td class="align-middle">
                      <a href="{{ route('customers.show', $record->id) }}" class="text-primary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Show Customer">
                          <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{ route('customers.edit', $record->id) }}" class="text-warning font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Edit Customer">
                          <i class="fas fa-pen"></i>
                      </a>
                      <a href="javascript:;" onclick="deleteFunction({{ $record->id }})" class="text-danger font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Delete Customer">
                          <i class="fas fa-trash"></i>
                      </a>
                      <form id="deleteForm{{ $record->id }}" method="POST" action="{{ route('customers.destroy', $record->id) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                  </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->id }}</span>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $record->first_name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $record->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->phone_number }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->cnic }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->address }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-<?php if ($record->status == 1) { echo 'warning'; } else if ($record->status == 2) { echo 'success'; } else { echo 'danger'; } ?>"><?php if ($record->status == 1) { echo 'PENDING'; } else if($record->status == 2) { echo 'APPROVED'; } else { echo 'NOT ACTIVE'; } ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->is_owner == 1 ? 'Yes' : 'No' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->remarks }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->created_at->toDateString() }}</span>
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
    // $(document).ready(function () {
    //   $("#table").DataTable();
    // })
  </script>
  @endsection