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
#sidebar-menu .menuitem-active .active{color:#fff !important;font-size:12px !important;font-weight:normal}
</style>

<div class="left-side-menu">
      <div class="h-100" data-simplebar>
         <!--- Sidemenu -->
         <div id="sidebar-menu">
            <ul id="side-menu">
               <li class="menu-title">Navigation</li>

                <li>
                  <a href="<?php echo e(route('dashboard')); ?>"><i class="fe-airplay"></i> <span><?php echo e(__('app.dashboard')); ?></span></a>
                </li>


                <li>
                  <a href="<?php echo e(route('inst_project_timeline')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.project_timeline')); ?></span></a>
                </li>

		<li>
                  <a href="<?php echo e(route('payments.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("Payment")); ?></span></a>
                </li>

                <!-- <li>
                  <a href="<?php echo e(route('lab_status')); ?>"><i class="fe-box"></i> <span><?php echo e(__('app.lab_status')); ?></span></a>
                </li> -->


<!--                  <li>
                  <a href="<?php echo e(route('equipments.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__('app.list_of_equipments')); ?></span></a>
                </li> -->

               <!--  <li>
                  <a href="#"><i class="fe-clipboard"></i> <span><?php echo e(__('app.use_case_development')); ?></span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-file-plus"></i> <span><?php echo e(__('app.documents')); ?></span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-dollar-sign"></i> <span><?php echo e(__('app.payments')); ?></span></a>
                </li> -->


		<li>
                  <a href="<?php echo e(route('expert_user.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("Experts Application")); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('poc_bsnl.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("BSNL Application")); ?></span></a>
                </li>


		<li>
  			<a href="<?php echo e(route('six_g_user.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("SixG Application")); ?></span></a>
		</li>


		<li>
                  <a href="<?php echo e(route('tickets.index')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.tickets_complaints')); ?></span></a>
                </li>


                <li>
                  <a href="#admin_user" data-bs-toggle="collapse"><i class="fe-user-plus"></i><span> <?php echo e(__('app.administration')); ?> </span><span class="menu-arrow"></span></a>
                  <div class="collapse" id="admin_user">
                     <ul class="nav-second-level">
                        <li>
                           <a title="<?php echo e(__('app.user_creation')); ?>" href="<?php echo e(route('institute_users.create')); ?>">User Create</a>
                        </li>
                        <li>
                           <a title="Users List" href="<?php echo e(route('institute_users.index')); ?>">Users List</a>
                        </li>
                     </ul>
                  </div>
                </li>
                <li>
                  <a href="<?php echo e(route('system_manual.index')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('Document')); ?></span></a>
                </li>

                <!-- <li>
                  <a href="<?php echo e(route('system_manual.signature-uat')); ?>"><i class="fe-list"></i> <span><?php echo e(__('Upload Document')); ?></span></a>
                </li> -->

                <!-- <li>
                  <a href="#"><i class="fe-user"></i> <span><?php echo e(__('app.user_management')); ?></span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-help-circle"></i> <span><?php echo e(__('app.help_desk')); ?></span></a>
                </li>
                <li>
                  <a href="#"><i class="fe-info"></i> <span><?php echo e(__('app.notifications')); ?></span></a>
                </li> -->

                

                <!-- <li>
                  <a href="#tickets_complaints" data-bs-toggle="collapse"><i class="fe-layers"></i><span> <?php echo e(__('app.tickets_complaints')); ?> </span><span class="menu-arrow"></span></a>
                  <div class="collapse" id="tickets_complaints" style="background:#595ba0;">
                     <ul class="nav-second-level">
                        <li>
                           <a title="<?php echo e(__('app.user_creation')); ?>" href="<?php echo e(route('tickets.index')); ?>"><?php echo e(__('app.create')); ?></a>
                        </li>
                        <li>
                           <a title="<?php echo e(__('app.user_detail')); ?>" href="<?php echo e(route('tickets.index')); ?>"><?php echo e(__('app.assigned')); ?></a>
                        </li>
                     </ul>
                  </div>
                </li>
 -->
                

            </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
</div>
<?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/partials/institute-left-side-bar.blade.php ENDPATH**/ ?>