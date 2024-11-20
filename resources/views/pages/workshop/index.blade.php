@extends('layouts.app')
@section('title', ' - Workshops')
@section('content')
<style type="text/css">
	.buttons-pdf{display:none}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">

		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('Workshops') }}</h3></div>
		            		<div class="col-md-6">
		            		</div>
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
