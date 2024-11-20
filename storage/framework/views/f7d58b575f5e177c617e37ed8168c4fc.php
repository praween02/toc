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

                <?php if(in_array('super_admin', get_roles()) OR in_array('admin_view', get_roles())): ?>
                <li>
                  <a href="<?php echo e(route('dashboard')); ?>"><i class="fe-airplay"></i> <span><?php echo e(__('app.dashboard')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('equipments.index')); ?>"><i class="fe-box"></i> <span><?php echo e(__('app.equipments')); ?></span></a>
                </li>


                <li>
                  <a href="<?php echo e(route('institutes.index')); ?>"><i class="fe-book"></i> <span><?php echo e(__('app.institutes')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('courses.index')); ?>"><i class="fe-book"></i> <span><?php echo e(__('app.courses')); ?></span></a>
                </li>

               

                <li>
                  <a href="<?php echo e(route('vendors.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('app.vendors')); ?></span></a>
                </li>

		<?php if(in_array('super_admin', $roles)): ?>

                <li>
                  <a href="<?php echo e(route('vendor_institutes.create')); ?>"><i class="fe-list"></i> <span><?php echo e(__('app.vendors_institute')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('roles.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('app.roles')); ?></span></a>
                </li>

		<?php endif; ?>

                <li>
                  <a href="<?php echo e(route('users.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('app.users')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('admin.projects_timeline')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.project_timeline')); ?></span></a>
                </li>

		<li>
                  <a href="<?php echo e(route('teams.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('app.committee')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('six_g_user.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('6G APPLICATIONS')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('poc_bsnl.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('BSNL APPLICATIONS')); ?></span></a>
                </li>

                <li>
                  <a href="<?php echo e(route('expert_user.index')); ?>"><i class="fe-users"></i> <span><?php echo e(__('Expert APPLICATIONS')); ?></span></a>
                </li>

		<li>
                  <a href="<?php echo e(route('expert.nda.admin')); ?>"><i class="fe-file"></i> <span><?php echo e(__('app.nda')); ?></span> <small class="smf">(Non-Disclosure Agreement)</small></a>
                </li>

		<li>
                  <a href="<?php echo e(route('payments.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("Payment")); ?></span></a>
                </li>

		<li>
                  <a href="<?php echo e(route('tickets.index')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.tickets_complaints')); ?></span></a>
                </li>


		<?php endif; ?>


		<?php if(current_user_id() == 1656): ?>

                <li>
                  <a href="<?php echo e(route('telecom.dashboard')); ?>"><i class="fe-list"></i> <span><?php echo e(__("Dashboard")); ?></span></a>
                </li>   
				
				<li>
                  <a href="<?php echo e(route('telecom.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("Projects")); ?></span></a>
                </li>

	       <?php endif; ?>



                <!-- <li>
                  <a href="#"><i class="fe-file"></i> <span><?php echo e(__('app.5g_equipment_package')); ?></span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-file"></i> <span><?php echo e(__('app.delivery_status')); ?></span></a>
                </li>

                <li>
                  <a href="#"><i class="fe-file"></i> <span><?php echo e(__('app.no_students_startup_access_projects')); ?></span></a>
                </li> -->

            </ul>
         </div>
         <!-- End Sidebar -->
         <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
</div>
<?php /**PATH D:\development\htdocs\projects\toc\portal\resources\views/partials/left-side-bar.blade.php ENDPATH**/ ?>