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
          <h6>Add Customer</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
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
                    <div class="row">
                        <div class="col-md-6">
                            <label for="first_name" class="form-control-label">First Name*</label>
                            <input class="form-control" name="first_name" value="{{ old('first_name') }}" type="text" placeholder="First Name" id="first_name">
                            @error('first_name')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-control-label">Last Name</label>
                            <input class="form-control" name="last_name" value="{{ old('last_name') }}" type="text" placeholder="Last Name" id="last_name">
                            @error('last_name')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="dealer" class="form-control-label">Dealer</label>
                            <input class="form-control" name="dealer" value="{{ old('dealer') }}" type="text" placeholder="Dealer" id="dealer">
                            @error('dealer')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="proprietor" class="form-control-label">Proprietor</label>
                            <input class="form-control" name="last_name" value="{{ old('proprietor') }}" type="text" placeholder="Proprietor" id="proprietor">
                            @error('proprietor')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="reference" class="form-control-label">Reference</label>
                            <input class="form-control" name="reference" value="{{ old('reference') }}" type="text" placeholder="Reference" id="reference">
                            @error('reference')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="is_ownerr" class="form-control-label">Is Owner</label>
                            <select name="is_owner" class="form-control" id="is_owner">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('proprietor')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" name="email" value="{{ old('email') }}" type="email" placeholder="@example.com" id="email">
                            @error('email')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-control-label">Phone</label>
                            <input class="form-control" type="tel" value="{{ old('phone_number') }}" name="phone_number" placeholder="Phone Number" id="phone_number">
                            @error('phone_number')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="phone_number2" class="form-control-label">Phone 2</label>
                            <input class="form-control" type="tel" value="{{ old('phone_number2') }}" name="phone_number2" placeholder="Phone Number 2" id="phone_number2">
                            @error('phone_number2')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number3" class="form-control-label">Phone 3</label>
                            <input class="form-control" type="tel" value="{{ old('phone_number3') }}" name="phone_number3" placeholder="Phone Number 3" id="phone_number3">
                            @error('phone_number3')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="cnic" class="form-control-label">Cnic</label>
                            <input class="form-control" value="{{ old('cnic') }}" name="cnic" placeholder="Cnic" type="number" id="cnic">
                            @error('cnic')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="cnic_pic" class="form-control-label">Cnic Picture</label>
                            <input class="form-control" value="{{ old('cnic_pic') }}" name="cnic_pic" placeholder="Cnic Picture" type="file" id="cnic_pic">
                            @error('cnic_pic')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="form-control-label">Address</label>
                    <textarea class="form-control" value="{{ old('address') }}" name="address" id="address"></textarea>
                    @error('address')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address2" class="form-control-label">Address 2</label>
                            <input class="form-control" name="address2" value="{{ old('address2') }}" type="text" placeholder="Address 2" id="address2">
                            @error('address2')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address3" class="form-control-label">Address 3</label>
                            <input class="form-control" name="address3" value="{{ old('address3') }}" type="text" placeholder="Address 3" id="address3">
                            @error('address3')
                            <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="form-control-label">Remarks</label>
                    <textarea class="form-control" value="{{ old('remarks') }}" name="remarks" id="remarks"></textarea>
                    @error('remarks')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="agreement" class="form-control-label">Agreement</label>
                    <textarea class="form-control" value="{{ old('agreement') }}" name="agreement" id="agreement"></textarea>
                    @error('agreement')
                    <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Save" class="btn btn-success float-end">
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