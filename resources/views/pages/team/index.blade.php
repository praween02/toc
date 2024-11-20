@extends('layouts.app')
@section('title', ' - Committees')
@section('content')
<style>
.badge{font-size:11px;font-weight:normal;}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('app.committees') }}</h3></div>

		            		  @if( ! permission('users.create'))
		            				<div class="col-md-6 text-end"><a href="{{ route('teams.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('app.add_committee') }}</a></div>
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
