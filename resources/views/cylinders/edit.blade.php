@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('cylinders.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--text">Go Back</span>
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                </a>
                <h6 class="text-danger">Delete Cylinders</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('cylinders.modify') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                                <h4>45 Kg Cylinders Entry</h4>
                                <div class="row">
                                    <div class="col-md-112">
                                        <label for="gcylinders45" class="form-control-label">Good Cylinders</label>
                                        <input class="form-control" name="gcylinders45" value="{{ old('gcylinders45', 0) }}" type="number" placeholder="Number Of Cylinders" id="gcylinders45">
                                        @error('gcylinders45')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="bcylinders45" class="form-control-label">Bad Cylinders</label>
                                        <input class="form-control" name="bcylinders45" value="{{ old('bcylinders45', 0) }}" type="number" placeholder="Number Of Cylinders" id="bcylinders45">
                                        @error('bcylinders45')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="wcylinders45" class="form-control-label">Worst Cylinders</label>
                                        <input class="form-control" name="wcylinders45" value="{{ old('wcylinders45', 0) }}" type="number" placeholder="Number Of Cylinders" id="wcylinders45">
                                        @error('wcylinders45')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                                <h4>11 Kg Cylinders Entry</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="gcylinders11" class="form-control-label">Good Cylinders</label>
                                        <input class="form-control" name="gcylinders11" value="{{ old('gcylinders11', 0) }}" type="number" placeholder="Number Of Cylinders" id="gcylinders11">
                                        @error('gcylinders11')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="bcylinders11" class="form-control-label">Bad Cylinders</label>
                                        <input class="form-control" name="bcylinders11" value="{{ old('bcylinders11', 0) }}" type="number" placeholder="Number Of bcylinders11" id="bcylinders11">
                                        @error('bcylinders11')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="wcylinders11" class="form-control-label">Worst Cylinders</label>
                                        <input class="form-control" name="wcylinders11" value="{{ old('wcylinders11', 0) }}" type="number" placeholder="Number Of Cylinders" id="wcylinders11">
                                        @error('wcylinders11')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group p-3" style="border: 1px solid #DCE0DF">
                                <h4>6 Kg Cylinders Entry</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="gcylinders6" class="form-control-label">Good Cylinders</label>
                                        <input class="form-control" name="gcylinders6" value="{{ old('gcylinders6', 0) }}" type="number" placeholder="Number Of Cylinders" id="gcylinders6">
                                        @error('gcylinders6')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="bcylinders6" class="form-control-label">Bad Cylinders</label>
                                        <input class="form-control" name="bcylinders6" value="{{ old('bcylinders6', 0) }}" type="number" placeholder="Number Of Cylinders" id="bcylinders6">
                                        @error('bcylinders6')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="wcylinders6" class="form-control-label">Worst Cylinders</label>
                                        <input class="form-control" name="wcylinders6" value="{{ old('wcylinders6', 0) }}" type="number" placeholder="Number Of Cylinders" id="wcylinders6">
                                        @error('wcylinders6')
                                        <span class="text-danger text-xs font-weight-bolder">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection