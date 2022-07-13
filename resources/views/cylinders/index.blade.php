@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <a href="{{ route('cylinders.create') }}" class="btn btn-icon btn-3 btn-success float-start" type="button">
      <span class="btn-inner--icon"><i class="fas fa-share"></i></span>
    <span class="btn-inner--text">Add</span>
  </a>
    {{-- <a href="{{ route('cylinders.sold') }}" class="btn btn-icon btn-3 btn-info float-end" type="button">
      <span class="btn-inner--icon"><i class="fas fa-info-circle"></i></span>
    <span class="btn-inner--text">Show Sold Cylinders</span>
  </a> --}}
  </div>
  @if (!empty($data))
  <div class="row">
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Last Update</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $last_update }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Cylinders</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->total }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Present Cylinders</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->present_total }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Remaining Cylinders</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->remaining_total }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Filled Cylinders</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->remaining_filled_total }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Empty Cylinders</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->remaining_empty_total }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Sold Cylinders</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->total_sold }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mb-lg-0 mb-4">
      <div class="card my-3">
        <div class="card-body p-3">
          <div class="row">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">On Party</p>
              <h6 class="font-weight-bolder mb-0">
                  {{ $data->onparty_total }}
              </h6>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card my-3">
      <div class="card-body p-3">
        <div class="row">
          <div class="numbers">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Commercial (45.4 kg) Cylinders</p>
            <dl class="row p-2">
              <dt class="col-sm-4">Total</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->total_commercial }}</dd>
              <dt class="col-sm-4">Present</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->present_commercial }}</dd>
              <dt class="col-sm-4">Remaining</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_commercial }}</dd>
              <dt class="col-sm-4">Filled</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_filled_commercial }}</dd>
              <dt class="col-sm-4">Empty</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_empty_commercial }}</dd>
              <dt class="col-sm-4">On Party</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->onparty_commercial }}</dd>
              <dt class="col-sm-4">Sold</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->sold_commercial }}</dd>
            </dl>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card my-3">
      <div class="card-body p-3">
        <div class="row">
          <div class="numbers">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Domestic (11.8 kg) Cylinders</p>
            <dl class="row p-2">
              <dt class="col-sm-4">Total</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->total_domestic }}</dd>
              <dt class="col-sm-4">Present</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->present_domestic }}</dd>
              <dt class="col-sm-4">Remaining</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_domestic }}</dd>
              <dt class="col-sm-4">Filled</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_filled_domestic }}</dd>
              <dt class="col-sm-4">Empty</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_empty_domestic }}</dd>
              <dt class="col-sm-4">On Party</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->onparty_domestic }}</dd>
              <dt class="col-sm-4">Sold</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->sold_domestic }}</dd>
            </dl>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card my-3">
      <div class="card-body p-3">
        <div class="row">
          <div class="numbers">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Domestic (6 kg) Cylinders</p>
            <dl class="row p-2">
              <dt class="col-sm-4">Total</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->total_domestic6 }}</dd>
              <dt class="col-sm-4">Present</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->present_domestic6 }}</dd>
              <dt class="col-sm-4">Remaining</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_domestic6 }}</dd>
              <dt class="col-sm-4">Filled</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_filled_domestic6 }}</dd>
              <dt class="col-sm-4">Empty</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_empty_domestic6 }}</dd>
              <dt class="col-sm-4">On Party</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->onparty_domestic6 }}</dd>
              <dt class="col-sm-4">Sold</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->sold_domestic6 }}</dd>
            </dl>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 mb-lg-0 mb-4">
    <div class="card my-3">
      <div class="card-body p-3">
        <div class="row">
          <div class="numbers">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Domestic (10 kg) Cylinders</p>
            <dl class="row p-2">
              <dt class="col-sm-4">Total</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->total_domestic10 }}</dd>
              <dt class="col-sm-4">Present</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->present_domestic10 }}</dd>
              <dt class="col-sm-4">Remaining</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_domestic10 }}</dd>
              <dt class="col-sm-4">Filled</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_filled_domestic10 }}</dd>
              <dt class="col-sm-4">Empty</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->remaining_empty_domestic10 }}</dd>
              <dt class="col-sm-4">On Party</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->onparty_domestic10 }}</dd>
              <dt class="col-sm-4">Sold</dt>
              <dd class="col-sm-8 font-weight-bolder text-success">{{ $data->sold_domestic10 }}</dd>
            </dl>
        </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <h4 class="text-danger">No Cylinders Found</h4>
  @endif
  {{--<div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <a href="{{ route('cylinders.modify') }}" class="btn btn-icon btn-3 btn-danger" type="button">
              <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
            <span class="btn-inner--text">Delete</span>
          </a>
          <a href="{{ route('cylinders.create') }}" class="btn btn-icon btn-3 btn-primary float-end" type="button">
              <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            <span class="btn-inner--text">Add</span>
          </a>
          <h6>All Cylinders</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0" id="table">
              <thead>
                <tr>
                  <th class="text-center text-secondary opacity-7"></th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Id</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Type</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Wall Type</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Date Purchased</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Condition</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Created At</th>
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
                      <a href="{{ route('cylinders.show', $record->id) }}" class="text-primary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Show Cylinder">
                          <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{ route('cylinders.edit', $record->id) }}" class="text-warning font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Edit Cylinder">
                          <i class="fas fa-pen"></i>
                      </a>
                      <a href="javascript:;" onclick="deleteFunction({{ $record->id }})" class="text-danger font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Delete Cylinder">
                          <i class="fas fa-trash"></i>
                      </a>
                      <form id="deleteForm{{ $record->id }}" method="POST" action="{{ route('cylinders.destroy', $record->id) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                  </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->id }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->type }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->wall_type }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->date_purchased }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->condition }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->status }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $record->created_at->toDateString() }}</span>
                    </td>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> --}}
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