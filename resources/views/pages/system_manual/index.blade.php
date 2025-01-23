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
                                        <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">Upload Document</button>
                                        <a class="nav-link" href="{{ route('system_manual.signature-uat') }}" >Institute Document</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Upload Document Tab -->
                                    <div class="mpm-10 tab-pane fade show active" id="nav-application" role="tabpanel" aria-labelledby="nav-application-tab">
                                        <div class="row">
											<div class="col-md-6 float-left"><h3>{{ __('Upload Document') }}</h3></div>
											<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Upload Document') }}</a></div>
										</div>
										{{ $dataTable->table(['class' => 'table table-bordered']) }}
                                    </div>
                                    <!-- Implement Of Documents Tab -->
                                    
                                </div>
                            </div>
							@endif
							@if(in_array('institute', get_roles()))
							<div class="row jumbotron box8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">View Document</button>
                                        <a class="nav-link" href="{{ route('system_manual.signature-uat') }}" >Upload Document</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Upload Document Tab -->
                                    <div class="mpm-10 tab-pane fade show active" id="nav-application" role="tabpanel" aria-labelledby="nav-application-tab">
										<div class="row">
											<div class="col-md-6 float-left"><h3>{{ __('View Document') }}</h3></div>
											<!-- <div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Upload Document') }}</a></div> -->
										</div>
										{{ $dataTable->table(['class' => 'table table-bordered']) }}
                                    </div>
                                    <!-- Implement Of Documents Tab -->
                                    
                                </div>
                            </div>
							@endif
							@if(in_array('super_admin', get_roles()))
							<div class="row">
								<div class="col-md-6 float-left"><h3>{{ __('Document') }}</h3></div>
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Document') }}</a>
								<!-- <a href="{{ route('system_manual.signature-create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('UAT Signed Document') }}</a>
								<a href="{{ route('system_manual.receipt-goods-create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Receipt of goods Document') }}</a> -->
								</div>
							</div>
							{{ $dataTable->table(['class' => 'table table-bordered']) }}
							@endif
							<!-- @if(in_array('institute', get_roles()))
							<div class="col-md-6 float-left"><h3>{{ __('UAT Document') }}</h3></div>
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('UAT Document') }}</a></div>
							@endif -->

		            		
		            		<!-- {{ ucwords(Auth::user()->id) }}  -->
							

						

		                
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