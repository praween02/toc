<div class="navbar-custom">
   <div class="container-fluid">
      <ul class="list-unstyled topnav-menu float-end mb-0">
         <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
               <form class="p-3">
                  <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
               </form>
            </div>
         </li>
         <li class="dropdown d-none d-lg-inline-block">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
            <i class="fe-maximize noti-icon"></i>
            </a>
         </li>
         <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            
	    <?php if(Auth::user()->profile_photo_url): ?>
            <img src="<?php echo e(url('storage/' . Auth::user()->profile_photo_url)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="rounded-full h-20 w-20 object-cover" />
            <?php else: ?>
            <img src="<?php echo e(url('assets/images/user_icon.png')); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="rounded-full h-20 w-20 object-cover" />
            <?php endif; ?>

            <span class="pro-user-name ms-1">
              <i class="mdi mdi-chevron-down"></i>
            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

               <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome <?php echo e(ucwords(Auth::user()->name)); ?> !</h6>
               </div>

               <a href="<?php echo e(route('profile.show')); ?>" class="dropdown-item notify-item">
               <i class="fe-user"></i>
               <span>My Account</span>
               </a>

               <div class="dropdown-divider"></div>

               <form id="header_logout_form" action="<?php echo e(route('logout')); ?>" method="POST">
                     <?php echo csrf_field(); ?>
                     <a class="dropdown-item notify-item" href="javascript:void(0)" onclick="document.getElementById('header_logout_form').submit();">
                        <i class="fa fa-sign-out-alt"></i>
                        <span> Logout </span>
                     </a>
               </form>

            </div>
         </li>
      </ul>
      <!-- LOGO -->
      <div class="logo-box">

         <a href="<?php echo e(url('/')); ?>" class="logo logo-light text-center">
            <span class="logo-sm">
               <?php if(current_user_id() == 1656 OR in_array('project_manager', get_roles())): ?>
               <h5 style="background:#f9f9f9;line-height:40px;font-weight:500;font-size:15px">Telecom Project Management</h5>
                <?php else: ?>
               <?php if (isset($component)) { $__componentOriginal1a590bee94ab2d9c08b342367154fca0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a590bee94ab2d9c08b342367154fca0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.authentication-card-logo','data' => ['src' => ''.e(asset('assets/images/5glogo.png')).'','width' => '60']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('authentication-card-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => ''.e(asset('assets/images/5glogo.png')).'','width' => '60']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a590bee94ab2d9c08b342367154fca0)): ?>
<?php $attributes = $__attributesOriginal1a590bee94ab2d9c08b342367154fca0; ?>
<?php unset($__attributesOriginal1a590bee94ab2d9c08b342367154fca0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a590bee94ab2d9c08b342367154fca0)): ?>
<?php $component = $__componentOriginal1a590bee94ab2d9c08b342367154fca0; ?>
<?php unset($__componentOriginal1a590bee94ab2d9c08b342367154fca0); ?>
<?php endif; ?>
               <?php endif; ?>
            </span>
            <span class="logo-lg">
               <?php if(current_user_id() == 1656 OR in_array('project_manager', get_roles())): ?>
               <h5 style="background:#f9f9f9;line-height:40px;font-weight:500;font-size:15px">Telecom Project Management</h5>
                <?php else: ?>
               <?php if (isset($component)) { $__componentOriginal1a590bee94ab2d9c08b342367154fca0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a590bee94ab2d9c08b342367154fca0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.authentication-card-logo','data' => ['src' => ''.e(asset('assets/images/5glogo.png')).'','width' => '120']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('authentication-card-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => ''.e(asset('assets/images/5glogo.png')).'','width' => '120']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a590bee94ab2d9c08b342367154fca0)): ?>
<?php $attributes = $__attributesOriginal1a590bee94ab2d9c08b342367154fca0; ?>
<?php unset($__attributesOriginal1a590bee94ab2d9c08b342367154fca0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a590bee94ab2d9c08b342367154fca0)): ?>
<?php $component = $__componentOriginal1a590bee94ab2d9c08b342367154fca0; ?>
<?php unset($__componentOriginal1a590bee94ab2d9c08b342367154fca0); ?>
<?php endif; ?>
               <?php endif; ?>
            </span>
         </a>
      </div>
      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
         <li>
            <button class="button-menu-mobile waves-effect waves-light">
               <i class="fe-menu"></i>
            </button>
         </li>
         <li>
            <!-- Mobile menu toggle (Horizontal Layout)-->
            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
               <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
            </a>
            <!-- End mobile menu toggle-->
         </li>
      </ul>
      <div class="clearfix"></div>
   </div>
</div><?php /**PATH D:\wamp64\www\projects\bharat5glab\toc\resources\views/partials/top-bar.blade.php ENDPATH**/ ?>