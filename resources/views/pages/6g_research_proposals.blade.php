@extends('layouts.app')
@section('title', ' - 6G Research Proposals')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('6G Research Proposals') }}</h3></div>
		            	</div>

		            	<table id="experts" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Proposal details</th>
					                <th>Technology domain</th>
					                <th>Area</th>
					                <th>Project title</th>
					                <th>Organization Name</th>
					                <th>Address</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@forelse($users as $user)
						            <tr>
						                <td>{{ $user->proposalDetails }}</td>
						                <td>{{ $user->technologyDomain }}</td>
						                <td>{{ $user->Area }}</td>
						                <td>{{ $user->projectTitle }}</td>
						                <td>{{ $user->organizationName }}</td>
						                <td>{{ $user->address }}</td>
						                <td class=""><a title="View Details" href="{{ route('6g-research-proposal-summary', $user->id) }}"><i class="fa fa-eye">&nbsp;</i></td>
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
