@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
            <a href="{{ route('users.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
            </a>
            <h6>{{ Str::ucfirst($data->name) }} Details</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <dl class="row p-4">
                <dt class="col-sm-3">Profile Image</dt>
                <dd class="col-sm-9">
                    @if ($data->profile != null)
                    <img src="{{ asset('assets/img/'.$data->profile) }}" height="200" width="200" class="img-fluid border-radius-lg">    
                    @else
                        No Image Set
                    @endif
                </dd>
                <hr>
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ Str::ucfirst($data->name) }}</dd>
                <hr>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $data->email }}</dd>
                <hr>
                <dt class="col-sm-3">Phone Number</dt>
                <dd class="col-sm-9">{{ $data->phone_number }}</dd>
                <hr>
                <dt class="col-sm-3">Cnic</dt>
                <dd class="col-sm-9">{{ $data->cnic }}</dd>
                <hr>
                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $data->address }}</dd>
                <hr>
                <dt class="col-sm-3">Is Active</dt>
                <dd class="col-sm-9">{{ $data->is_active == 1 ? 'Yes' : 'No' }}</dd>
                <hr>
                <dt class="col-sm-3">Role</dt>
                <dd class="col-sm-9">{{ $data->role == 1 ? 'Admin' : 'Other' }}</dd>
                <hr>
                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $data->created_at }} || {{ $data->created_at->diffForHumans() }}</dd>
                <hr>
                <dt class="col-sm-3">Last Update</dt>
                <dd class="col-sm-9">{{ $data->updated_at }} || {{ $data->updated_at->diffForHumans() }}</dd>
                <hr>
              </dl>
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