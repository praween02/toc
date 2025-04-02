@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Equipment Details</h4>

                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('equipment-list.index') }}">
                            <i class="fe-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200px">Equipment Name</th>
                                <td>{{ $equipmentList->equipment_name }}</td>
                            </tr>
                            <tr>
                                <th>Model No</th>
                                <td>{{ $equipmentList->model_no }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ $equipmentList->date }}</td>
                            </tr>
                            <tr>
                                <th>Running Time</th>
                                <td>{{ $equipmentList->running_time }}</td>
                            </tr>
                            <tr>
                                <th>Institute</th>
                                <td>{{ $equipmentList->institute->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $equipmentList->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $equipmentList->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 