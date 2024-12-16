<style type="text/css">
   .active{font-weight:bold}
   #sidebar-menu>ul>li>form>a{font-size:13px !important;}
   #sidebar-menu>ul>li>form>a{
    color: #6e768e;
    display: block;
    padding: 12px 20px;
    position: relative;
    transition: all .4s;
    font-family: Poppins,sans-serif;
    font-size: 14.35px;
}
#sidebar-menu>ul>li>form>a>span {
    vertical-align: middle;
}
#sidebar-menu>ul>li>form>a i {
    display: inline-block;
    line-height: 1.0625rem;
    margin: 0 10px 0 3px;
    text-align: center;
    vertical-align: middle;
    width: 16px;
    font-size: 16px;
}
body[data-sidebar-size=condensed] .left-side-menu #sidebar-menu>ul>li>form>a span {
    display: none;
    padding-left: 25px;
}
</style>

<div class="left-side-menu">
      <div class="h-100" data-simplebar>
         <!--- Sidemenu -->
         <div id="sidebar-menu">
            <ul id="side-menu">
               <li class="menu-title">Navigation</li>

                @if(in_array('super_admin', get_roles()) OR in_array('admin_view', get_roles()))
                <li>
                  <a href="{{ route('dashboard') }}"><i class="fe-airplay"></i> <span>{{ __('app.dashboard') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('equipments.index') }}"><i class="fe-box"></i> <span>{{ __('app.equipments') }}</span></a>
                </li>


                <li>
                  <a href="{{ route('institutes.index') }}"><i class="fe-book"></i> <span>{{ __('app.institutes') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('courses.index') }}"><i class="fe-book"></i> <span>{{ __('app.courses') }}</span></a>
                </li>

               

                <li>
                  <a href="{{ route('vendors.index') }}"><i class="fe-users"></i> <span>{{ __('app.vendors') }}</span></a>
                </li>

		@if(in_array('super_admin', $roles))

                <li>
                  <a href="{{ route('vendor_institutes.create') }}"><i class="fe-list"></i> <span>{{ __('app.vendors_institute') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('roles.index') }}"><i class="fe-users"></i> <span>{{ __('app.roles') }}</span></a>
                </li>

		@endif

                <li>
                  <a href="{{ route('users.index') }}"><i class="fe-users"></i> <span>{{ __('app.users') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('admin.projects_timeline') }}"><i class="fe-menu"></i> <span>{{ __('app.project_timeline') }}</span></a>
                </li>

		<li>
                  <a href="{{ route('teams.index') }}"><i class="fe-users"></i> <span>{{ __('app.committee') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('six_g_user.index') }}"><i class="fe-users"></i> <span>{{ __('6G APPLICATIONS') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('poc_bsnl.index') }}"><i class="fe-users"></i> <span>{{ __('BSNL APPLICATIONS') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('expert_user.index') }}"><i class="fe-users"></i> <span>{{ __('Expert APPLICATIONS') }}</span></a>
                </li>

		<li>
                  <a href="{{ route('expert.nda.admin') }}"><i class="fe-file"></i> <span>{{ __('app.nda') }}</span> <small class="smf">(Non-Disclosure Agreement)</small></a>
                </li>

		<li>
                  <a href="{{ route('payments.index') }}"><i class="fe-list"></i> <span>{{ __("Payment") }}</span></a>
                </li>

		<li>
                  <a href="{{ route('tickets.index') }}"><i class="fe-menu"></i> <span>{{ __('app.tickets_complaints') }}</span></a>
                </li>
                <li>
          <a href="{{ route('system_manual.index') }}"><i class="fe-list"></i> <span>{{ __("Document") }}</span></a>
        </li>


		@endif


		@if(current_user_id() == 1656)

                <li>
                  <a href="{{ route('telecom.dashboard') }}"><i class="fe-list"></i> <span>{{ __("Dashboard") }}</span></a>
                </li>   
				
				<li>
                  <a href="{{ route('telecom.index') }}"><i class="fe-list"></i> <span>{{ __("Projects") }}</span></a>
                </li>

	       @endif



                <!-- <li>
                  <a href="#"><i class="fe-file"></i> <span>{{ __('app.5g_equipment_package') }}</span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-file"></i> <span>{{ __('app.delivery_status') }}</span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-file"></i> <span>{{ __('app.no_students_startup_access_projects') }}</span></a>
                </li> -->

            </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
</div>
