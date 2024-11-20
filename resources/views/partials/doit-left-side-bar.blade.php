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

                <li>
                  <a href="{{ route('dashboard') }}"><i class="fe-airplay"></i> <span>{{ __('app.dashboard') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('institutes.index') }}"><i class="fe-box"></i> <span>{{ __('app.lab_status') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('users.index') }}"><i class="fe-send"></i> <span>{{ __('app.equipment_supplier') }}</span></a>
                </li>


                 <li>
                  <a href="{{ route('users.index') }}"><i class="fe-list"></i> <span>{{ __('app.list_of_equipments') }}</span></a>
                </li>



                <li>
                  <a href="{{ route('roles.index') }}"><i class="fe-clipboard"></i> <span>{{ __('app.use_case_development') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('users.index') }}"><i class="fe-file-plus"></i> <span>{{ __('app.documents') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('roles.index') }}"><i class="fe-dollar-sign"></i> <span>{{ __('app.payments') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('users.index') }}"><i class="fe-user-plus"></i> <span>{{ __('app.administration') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('roles.index') }}"><i class="fe-user"></i> <span>{{ __('app.user_management') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('users.index') }}"><i class="fe-help-circle"></i> <span>{{ __('app.help_desk') }}</span></a>
                </li>

                <li>
                  <a href="{{ route('roles.index') }}"><i class="fe-menu"></i> <span>{{ __('app.list_of_institution') }}</span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-book"></i> <span>{{ __('app.project_timeline_status') }}</span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-menu"></i> <span>{{ __('app.tickets_complaints') }}</span></a>
                </li>

            </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
</div>
