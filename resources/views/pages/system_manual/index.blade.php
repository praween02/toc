@extends('layouts.app')
@section('title', ' - System Manual')
@section('content')
<style type="text/css">
table tr td:first-child{width:75%}	
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">               
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('System Manual') }}</h3></div>

		            	
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('System Manual') }}</a></div>
		            		
		            		
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