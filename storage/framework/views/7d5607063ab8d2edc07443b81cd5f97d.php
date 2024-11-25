<style type="text/css">
  .active {
    font-weight: bold
  }

  #sidebar-menu>ul>li>form>a {
    font-size: 13px !important;
  }

  #sidebar-menu>ul>li>form>a {
    color: #6e768e;
    display: block;
    padding: 12px 20px;
    position: relative;
    transition: all .4s;
    font-family: Poppins, sans-serif;
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

  #sidebar-menu .menuitem-active .active {
    color: #fff !important;
    font-size: 12px !important;
    font-weight: normal
  }
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
          <a href="<?php echo e(route('project_timeline')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.project_timeline')); ?></span></a>
        </li>

        <li>
          <a href="<?php echo e(route('equipments.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__('app.list_of_equipments')); ?></span></a>
        </li>

        <li>
          <a href="<?php echo e(route('institutes.index')); ?>"><i class="fe-home"></i> <span><?php echo e(__('app.list_of_institutions')); ?></span></a>
        </li>

        <!-- <li>
                  <a href="#"><i class="fe-book-open"></i> <span><?php echo e(__('app.documentation')); ?></span></a>
                </li> -->

        <!-- <li>
                  <a style="font-size:11px !important;letter-spacing:0.4px" href="<?php echo e(route('assignment')); ?>"><i class="fe-book"></i> <span>Communication to Institutes</span></a>
                </li> -->

        <!-- <li>
                  <a href="<?php echo e(route('tickets.index')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.tickets_complaints')); ?></span></a>
                </li> -->

        <li>
          <a href="<?php echo e(route('tickets.index')); ?>"><i class="fe-menu"></i> <span><?php echo e(__('app.tickets_complaints')); ?></span></a>
        </li>

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
          <a href="<?php echo e(route('system_manual.index')); ?>"><i class="fe-list"></i> <span><?php echo e(__("System Manual")); ?></span></a>
        </li>





      </ul>
    </div>
    <!-- End Sidebar -->
    <div class="clearfix"></div>
  </div>
  <!-- Sidebar -left -->
</div><?php /**PATH D:\wamp64\www\projects\dot\resources\views/partials/vendor-left-side-bar.blade.php ENDPATH**/ ?>