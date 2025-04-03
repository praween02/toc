@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lab Gradings</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('lab.grading.create') }}" class="btn btn-primary">Create New Lab Grading</a>
                    </div>

                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
    <!-- End Content-->
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush 