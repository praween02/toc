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
#sidebar-menu>ul>li>a{padding:12px 7px !important}
</style>

<div class="left-side-menu">
      <div class="h-100" data-simplebar>
         <!--- Sidemenu -->
         <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                
		<li>
                  <a href="{{ route('dashboard') }}"><i class="fe-list"></i> <span>{{ __("Dashboard") }}</span></a>
                </li>

                <li>
                  <a href="{{ route('expert_user.index') }}"><i class="fe-list"></i> <span>{{ __("Experts Application") }}</span></a>
                </li>

                <li>
                  <a href="{{ route('poc_bsnl.index') }}"><i class="fe-list"></i> <span>{{ __("BSNL Application") }}</span></a>
                </li>


                <li>
                  <a href="{{ route('six_g_user.index') }}"><i class="fe-list"></i> <span>{{ __("SixG Application") }}</span></a>
                </li>

		<li>
                  <a href="{{ route('expert_user_assigned') }}"><i class="fe-list"></i> <span>{{ __('Assigned Expert Application') }}</span></a>
                </li>

		@if(check_expert_app_exist())
                <li>
                  <a href="{{ route('expert.nda') }}"><i class="fe-file"></i> <span>{{ __('app.nda') }}</span>&nbsp;<small class="sm">(Non-Disclosure Agreement)</small></a>
                </li>
                @endif



            </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
</div>