@extends('layouts.app')
@section('title', ' - Equipments')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('app.equipments') }}</h3></div>

		            		@if( ! permission('equipment.create'))
		            			<div class="col-md-6 text-end"><a href="{{ route('equipments.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('app.equipment') }}</a></div>
		            		@endif
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