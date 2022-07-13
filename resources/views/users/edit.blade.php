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
          <h6>Add User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                {{-- <div class="form-group">
                    <label for="profile" class="form-control-label">Select Profile Pic</label>
                    <input class="form-control" onchange="previewUserImage(this)" name="profile" value="{{ old('profile') }}" type="file" placeholder="select profile pic" id="profile">
                    <img id="userImg" src="{{ old('profile') }}" class="mt-2" style="max-height: 150px; max-width: 150px;">
                    @error('profile')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input class="form-control" name="name" value="{{ old('name', $data->name) }}" type="text" placeholder="Name" id="name">
                    @error('name')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-control-label">Email</label>
                    <input class="form-control" name="email" value="{{ old('email', $data->email) }}" type="email" placeholder="@example.com" id="email">
                    @error('email')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number" class="form-control-label">Phone</label>
                    <input class="form-control" type="tel" value="{{ old('phone_number', $data->phone_number) }}" name="phone_number" placeholder="Phone Number" id="phone_number">
                    @error('phone_number')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cnic" class="form-control-label">Cnic</label>
                    <input class="form-control" value="{{ old('cnic', $data->cnic) }}" name="cnic" placeholder="Cnic" type="number" id="cnic">
                    @error('cnic')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address" class="form-control-label">Address</label>
                    <textarea class="form-control" name="address" id="address">{{ old('address', $data->address) }}</textarea>
                    @error('address')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Update" class="btn btn-success float-end">
            </form>
        </div>
      </div>
    </div>
  </div>
    <script>
        function previewUserImage () {
            var post_file = $("#profile").get(0).files[0];
            if (post_file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#userImg').attr("src", reader.result);
                }

                reader.readAsDataURL(post_file);
            }
        }
    </script>
  @endsection