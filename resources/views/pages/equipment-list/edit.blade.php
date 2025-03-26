@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Equipment</h4>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('equipment-list.update', $equipmentList->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="institute_id" class="col-sm-2 col-form-label">Institute</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="institute_id" name="institute_id" required>
                                    <option value="">Select Institute</option>
                                    @foreach($institutes as $institute)
                                        <option value="{{ $institute->id }}" {{ $equipmentList->institute_id == $institute->id ? 'selected' : '' }}>
                                            {{ $institute->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="equipment_name" class="col-sm-2 col-form-label">Equipment Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="{{ $equipmentList->equipment_name }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="model_no" class="col-sm-2 col-form-label">Model No</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="model_no" name="model_no" value="{{ $equipmentList->model_no }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" value="{{ $equipmentList->date }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="running_time" class="col-sm-2 col-form-label">Running Time</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="running_time" name="running_time" value="{{ $equipmentList->running_time }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a class="btn btn-secondary me-2" href="{{ route('equipment-list.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 