@extends('layouts.app')
@section('title', ' - Future Tech Experts')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('Future Tech Experts') }}</h3></div>
		            	</div>

		            	<table id="experts" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Family Name</th>
					                <th>First Name</th>
					                <th>Email</th>
					                <th>Address</th>
					                <th>City</th>
					                <th>Country</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@forelse($users as $user)
						            <tr>
						                <td>{{ $user->family_name }}</td>
						                <td>{{ $user->first_name }}</td>
						                <td>{{ $user->official_email }}</td>
						                <td>{{ $user->address }}</td>
						                <td>{{ $user->city }}</td>
						                <td>{{ $user->country }}</td>
						                <td class=""><a title="View Details" href="{{ route('future-tech-expert-summary', $user->id) }}"><i class="fa fa-eye">&nbsp;</i></td>
						            </tr>
					            @empty
					           	@endforelse
					        </tbody>
					    </table>

		                
		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
    	new DataTable('#experts');
    </script>
@endpush