@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Proposal Reviews</h4>
                            <a href="{{ route('proposal-reviews.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Review
                            </a>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
@endsection 