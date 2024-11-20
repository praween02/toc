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
                  <a href="{{ route('telecom.dashboard') }}"><i class="fe-list"></i> <span>{{ __("Dashboard") }}</span></a>
                </li>   


                <li>
                  <a href="{{ route('telecom.index') }}"><i class="fe-list"></i> <span>{{ __("Projects") }}</span></a>
                </li>

                <li>
                  <a href="{{ route('telecom.create') }}"><i class="fe-list"></i> <span>{{ __("Project Management") }}</span></a>
                </li>

            </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
</div>