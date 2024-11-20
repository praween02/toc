@extends('layouts.app')
@section('title', ' - Dashboard')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-12 float-left"><h3>{{ __('Dashboard') }}</h3></div>
		            	</div>
		           	<div class="row">
	                     <div class="col-md-6 col-xl-4">
	                        <div class="widget-rounded-circle card bg-purple shadow-none">
	                           <div class="card-body">
	                              <div class="row">
	                                 <div class="col-6">
	                                    <div class="avatar-lg rounded-circle bg-soft-light">
	                                       <i class="fe-book font-28 avatar-title text-white"></i>
	                                    </div>
	                                 </div>
	                                 <div class="col-6">
	                                    <div class="text-end">
	                                       <h2 class="text-white mt-2"><span data-plugin="counterup">1</span></h2>
	                                       <p class="text-white mb-0 text-truncate">Total Bills</p>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end row-->
	                           </div>
	                        </div>
	                        <!-- end widget-rounded-circle-->
	                     </div>
	                     <!-- end col-->
	                     <div class="col-md-6 col-xl-4">
	                        <div class="widget-rounded-circle card bg-info shadow-none">
	                           <div class="card-body">
	                              <div class="row">
	                                 <div class="col-6">
	                                    <div class="avatar-lg rounded-circle bg-soft-light">
	                                       <i class="fe-users font-28 avatar-title text-white"></i>
	                                    </div>
	                                 </div>
	                                 <div class="col-6">
	                                    <div class="text-end">
	                                       <h2 class="text-white mt-2"><span data-plugin="counterup">2</span></h2>
	                                       <p class="text-white mb-0 text-truncate">Total Employees</p>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end row-->
	                           </div>
	                        </div>
	                        <!-- end widget-rounded-circle-->
	                     </div>
	                     <!-- end col-->
                     	<!-- end col-->
	                     <div class="col-md-6 col-xl-4">
	                        <div class="widget-rounded-circle card bg-success shadow-none">
	                           <div class="card-body">
	                              <div class="row">
	                                 <div class="col-6">
	                                    <div class="avatar-lg rounded-circle bg-soft-light">
	                                       <i class="fe-users font-28 avatar-title text-white"></i>
	                                    </div>
	                                 </div>
	                                 <div class="col-6">
	                                    <div class="text-end">
	                                       <h2 class="text-white mt-2"><span data-plugin="counterup">1</span></h2>
	                                       <p class="text-white mb-0 text-truncate">Total Vendors</p>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end row-->
	                           </div>
	                        </div>
	                        <!-- end widget-rounded-circle-->
	                     </div>
	                     <!-- end col-->
                  	  </div>

                  	  <!-- row -->


                  	  <div class="row">
	                     <div class="col-md-6 col-xl-4">
	                        <div class="widget-rounded-circle card bg-info shadow-none">
	                           <div class="card-body">
	                              <div class="row">
	                                 <div class="col-6">
	                                    <div class="avatar-lg rounded-circle bg-soft-light">
	                                       <i class="fe-home font-28 avatar-title text-white"></i>
	                                    </div>
	                                 </div>
	                                 <div class="col-6">
	                                    <div class="text-end">
	                                       <h2 class="text-white mt-2"><span data-plugin="counterup">3</span></h2>
	                                       <p class="text-white mb-0 text-truncate">Branches</p>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end row-->
	                           </div>
	                        </div>
	                        <!-- end widget-rounded-circle-->
	                     </div>
	                     <!-- end col-->
	                     <div class="col-md-6 col-xl-4">
	                        <div class="widget-rounded-circle card bg-primary shadow-none">
	                           <div class="card-body">
	                              <div class="row">
	                                 <div class="col-6">
	                                    <div class="avatar-lg rounded-circle bg-soft-light">
	                                       <i class="fe-home font-28 avatar-title text-white"></i>
	                                    </div>
	                                 </div>
	                                 <div class="col-6">
	                                    <div class="text-end">
	                                       <h2 class="text-white mt-2"><span data-plugin="counterup">1</span></h2>
	                                       <p class="text-white mb-0 text-truncate">Total Departments</p>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end row-->
	                           </div>
	                        </div>
	                        <!-- end widget-rounded-circle-->
	                     </div>
	                     <!-- end col-->
                     	<!-- end col-->
	                     <div class="col-md-6 col-xl-4">
	                        <div class="widget-rounded-circle card bg-warning shadow-none">
	                           <div class="card-body">
	                              <div class="row">
	                                 <div class="col-6">
	                                    <div class="avatar-lg rounded-circle bg-soft-light">
	                                       <i class="fe-users font-28 avatar-title text-white"></i>
	                                    </div>
	                                 </div>
	                                 <div class="col-6">
	                                    <div class="text-end">
	                                       <h2 class="text-white mt-2"><span data-plugin="counterup">1</span></h2>
	                                       <p class="text-white mb-0 text-truncate">Total Designations</p>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end row-->
	                           </div>
	                        </div>
	                        <!-- end widget-rounded-circle-->
	                     </div>
	                     <!-- end col-->
                  	  </div>

                  	  <!-- row -->

		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
@endsection
