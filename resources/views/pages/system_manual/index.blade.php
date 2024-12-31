@extends('layouts.app')
@section('title', ' - System Manual')
@section('content')

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">               
		            <div class="card-body">
		            	<div class="row">
						

							@if(in_array('vendor', get_roles()))
							<div class="col-md-6 float-left"><h3>{{ __('Upload Document') }}</h3></div>
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Upload Document') }}</a></div>
							@endif
							@if(in_array('super_admin', get_roles()))
							<div class="col-md-6 float-left"><h3>{{ __('Document') }}</h3></div>
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Document') }}</a></div>
							@endif
							<!-- @if(in_array('institute', get_roles()))
							<div class="col-md-6 float-left"><h3>{{ __('UAT Document') }}</h3></div>
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('UAT Document') }}</a></div>
							@endif -->

		            		
		            		<!-- {{ ucwords(Auth::user()->id) }}  -->
		            	</div>

						

		                {{ $dataTable->table(['class' => 'table table-bordered']) }}
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