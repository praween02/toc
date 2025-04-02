@extends('layouts.app')
@section('title', ' - Equipments')
@section('content')
<div class="content-page">
    <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="card-title">{{ __('app.list_of_equipments') }}</h4>
                            <a href="{{ route('equipment-list.create') }}" class="btn btn-primary">
                                <i class="fe-plus"></i> Add New Equipment
                            </a>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <!-- Institute Filter Dropdown -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form action="{{ route('equipment-list.index') }}" method="GET">
                                    <div class="input-group">
                                        <select name="institute_id" class="form-control" id="institute-filter" {{ isset($userIsInstitute) && $userIsInstitute ? 'disabled' : '' }}>
                                            <option value="">All Institutes</option>
                                            @foreach($institutes as $institute)
                                                <option value="{{ $institute->id }}" 
                                                    {{ (isset($instituteId) && $instituteId == $institute->id) ? 'selected' : '' }}>
                                                    {{ $institute->institute }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" {{ isset($userIsInstitute) && $userIsInstitute ? 'disabled' : '' }}>Filter</button>
                                        </div>
                                    </div>
                                    
                                    @if(isset($userIsInstitute) && $userIsInstitute)
                                        <small class="text-muted">You are viewing equipment for your institute only.</small>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Equipment Name</th>
                                        <th>Model No</th>
                                        <th>Date</th>
                                        <th>Running Time</th>
                                        <th>Institute</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipmentList as $equipment)
                                    <tr>
                                        <td>{{ $equipment->id }}</td>
                                        <td>{{ $equipment->equipment_name }}</td>
                                        <td>{{ $equipment->model_no }}</td>
                                        <td>{{ $equipment->date }}</td>
                                        <td>{{ $equipment->running_time }}</td>
                                        <td>{{ $equipment->institute->institute ?? 'N/A' }}</td>
                                        <td>
                                            <form action="{{ route('equipment-list.destroy', $equipment->id) }}" method="POST">
                                                <a class="btn btn-info btn-sm" href="{{ route('equipment-list.show', $equipment->id) }}">
                                                    <i class="fe-eye"></i> View
                                                </a>
                                                <a class="btn btn-primary btn-sm" href="{{ route('equipment-list.edit', $equipment->id) }}">
                                                    <i class="fe-edit"></i> Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this equipment?')">
                                                    <i class="fe-trash-2"></i> Delete
                                                </button>
                                            </form>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Only add auto-submit for non-institute users
        @if(!isset($userIsInstitute) || !$userIsInstitute)
            $('#institute-filter').on('change', function() {
                $(this).closest('form').submit();
            });
        @endif
    });
</script>
@endsection
