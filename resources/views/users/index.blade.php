@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('users.create') }}" class="btn btn-icon btn-3 btn-primary float-end" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
              <span class="btn-inner--text">Add</span>
            </a>
          <h6>All Users</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-secondary opacity-7"></th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder ps-2">Function</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Phone</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Cnic</th>
                  {{-- <th class="text-uppercase text-secondary text-xs font-weight-bolder">Address</th> --}}
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Created At</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td class="align-middle">
                      <a href="{{ route('users.show', $user->id) }}" class="text-primary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Show user">
                          <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{ route('users.edit', $user->id) }}" class="text-warning font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Edit user">
                          <i class="fas fa-pen"></i>
                      </a>
                      <a href="javascript:;" onclick="deleteFunction({{ $user->id }})" class="text-danger font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Delete user">
                          <i class="fas fa-trash"></i>
                      </a>
                      <form id="deleteForm{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                  </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{ $user->profile != '' ? asset('assets/img/'.$user->profile) : asset('assets/img/team-3.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Manager</p>
                      <p class="text-xs text-secondary mb-0">Organization</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-{{ $user->status == 1 ? 'success' : 'danger' }}">{{ $user->status == 1 ? 'ONLINE' : 'OFFLINE' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $user->phone_number }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $user->cnic }}</span>
                    </td>
                    {{-- <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $user->address }}</span>
                    </td> --}}
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at->toDateString() }}</span>
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