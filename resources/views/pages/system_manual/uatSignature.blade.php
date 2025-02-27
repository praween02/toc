@extends('layouts.app')
@section('title', ' - System Manual')
@section('content')

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">               
		            <div class="card-body">
							@if(in_array('vendor', get_roles()))
							<div class="row jumbotron box8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link" href="{{ route('system_manual.index') }}">Upload Document</a>
										<button class="nav-link active" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Institute Document</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Upload Document Tab -->
                                    
                                    <!-- Implement Of Documents Tab -->
                                    <div class="mpm-10 tab-pane fade show active" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
										<div class="row">
											<div class="col-md-6 float-left"><h3>{{ __('Institute Document') }}</h3></div>
										</div>
										{{ $dataTable->table(['class' => 'table table-bordered']) }}
                                    </div>
                                </div>
                            </div>
							@endif
                            @if(in_array('institute', get_roles()))
							<div class="row jumbotron box8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link" href="{{ route('system_manual.index') }}">View Document</a>
										<button class="nav-link active" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Upload Document</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Upload Document Tab -->
                                    
                                    <!-- Implement Of Documents Tab -->
                                    <div class="mpm-10 tab-pane fade show active" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
										<div class="row">
											<div class="col-md-6 float-left"><h3>{{ __('Upload Document') }}</h3></div>
											<div class="col-md-6 text-end">
												<a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Document') }}</a>
												<!-- <a href="{{ route('system_manual.signature-create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('UAT Signed Document') }}</a>
												<a href="{{ route('system_manual.receipt-goods-create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Receipt of goods Document') }}</a> -->
											</div>
										</div>
										{{ $dataTable->table(['class' => 'table table-bordered']) }}
                                    </div>
                                </div>
                            </div>
							
                            @endif
                            
		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
@endsection


@push('scripts')
    @include('sections.datatable_js')
@endpush