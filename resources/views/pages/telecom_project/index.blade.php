@extends('layouts.app')
@section('title', ' - Projects')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('Telecom Projects') }}</h3></div>

		            		  @if( ! permission('users.create'))
		            				<div class="col-md-6 text-end"><a href="{{ route('telecom.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('app.add') }}</a></div>
		            		  @endif
		            	</div>

		            	<div class="row">
		            		<div class="col-md-6">
		            			<span class="mb-3"><strong>Core Technology</strong></span>

		            			<select name="core_technology" class="form-control" onchange="filter(this.value)">
		            				<option value="">-- Select --</option>
		            				@foreach($distinct_core_tech as $dis)
		            				<option {{ $sel_filter == $dis->core_technology ? "selected" : "" }} value="{{ $dis->core_technology }}">{{ $dis->core_technology }}</option>
		            				@endforeach
		            			</select>
		            		</div>
		            	</div> <br />

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

    <script>
    	function filter(val) {
    		let route = "{{ route('telecom.index') }}";
    		if (val)
    		location.href = `${route}?filter=${val}`;
    			else
    		location.href = `${route}`;
    	}
    </script>
@endpush
