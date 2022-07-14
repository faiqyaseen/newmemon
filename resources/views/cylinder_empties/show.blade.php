@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('empties.index') }}" class="btn btn-icon btn-3 btn-secondary float-end" type="button">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                <span class="btn-inner--text">Go Back</span>
                </a>
                <h6>Empties Record Of {{ $customer->first_name }} {{ $customer->last_name }}</h6>
                <div class="row">
                  <div class="col-md-12">
                    <p><b>Commercial 45.4Kg: {{ $empties->commercial_difference }}</b></p>
                    <p><b>Domestic 11.8Kg: {{ $empties->domestic_difference }} </b></p>
                    <p><b>Domestic 6Kg {{ $empties->domestic6_difference }} </b></p>
                    <p><b>Domestic 10Kg: {{ $empties->domestic10_difference }} </b></p>
                  </div>
                  {{-- <div class="col-md-4">
                    <p>Commercial (45.4kg) Difference: <span class="text-danger">{{ $empties->commercial_difference }}</span></p>
                    <p>Domestic (11.8kg) Difference: <span class="text-danger">{{ $empties->domestic_difference }}</span></p>
                    <p>Domestic (6kg) Difference: <span class="text-danger">{{ $empties->domestic6_difference }}</span></p>
                    <p>Domestic (10kg) Difference: <span class="text-danger">{{ $empties->domestic10_difference }}</span></p>
                  </div> --}}
                  {{-- <div class="col-md-4">
                    <p class="text-success">Commercial (45.4kg) Recieve: {{ $empties->commercial_recieve }}</p>
                    <p class="text-success">Domestic (11.8kg) Recieve: {{ $empties->domestic_recieve }}</p>
                    <p class="text-success">Domestic (6kg) Recieve: {{ $empties->domestic6_recieve }}</p>
                    <p class="text-success">Domestic (10kg) Recieve: {{ $empties->domestic10_recieve }}</p>
                  </div>
                  <div class="col-md-4">
                    <p class="text-warning">Commercial (45.4kg) Give: {{ $empties->commercial_give }}</p>
                    <p class="text-warning">Domestic (11.8kg) Give: {{ $empties->domestic_give }}</p>
                    <p class="text-warning">Domestic (6kg) Give: {{ $empties->domestic6_give }}</p>
                    <p class="text-warning">Domestic (10kg) Give: {{ $empties->domestic10_give }}</p>
                  </div> --}}
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-secondary text-center opacity-7"></th>
                                <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder">#</th>
                                <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder">Group</th>
                                <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder">Cylinder Type</th>
                                <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder">Quantity</th>
                                <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder">Created At</th>
                                <th class="text-uppercase text-center text-secondary text-xs font-weight-bolder">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $record)
                            <tr>
                                <td class="align-middle">
                                    <a href="{{ route('empties.edit', $record->id) }}" class="text-warning font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Record">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('empties.destroy', $record->id) }}" class="text-danger font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Record">
                                    <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="deleteForm{{ $record->id  }}" method="POST" action="{{ route('empties.destroy', $record->id) }}">
                                      @csrf
                                      @method('DELETE')
                                  </form>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $key + 1 }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-{{ $record->type == 1 ? 'success' : 'danger' }} text-xs font-weight-bold">{{ $record->type == 1 ? 'Recieved' : 'Give' }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                      @if ($record->cylinder_type == 1)
                                          Commercial (45.4kg)
                                      @elseif($record->cylinder_type == 2)
                                          Domestic (11.8kg)
                                      @elseif($record->cylinder_type == 3)
                                          Domestic (6kg)
                                      @elseif($record->cylinder_type == 4)
                                          Domestic (10kg)
                                      @endif
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-{{ $record->type == 1 ? 'success' : 'danger' }} text-xs font-weight-bold">{{ $record->quantity }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ dateForHumans($record->created_at) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ dateForHumans($record->updated_at) }}</span>
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