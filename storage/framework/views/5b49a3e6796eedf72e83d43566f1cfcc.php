<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Bharat 5G Labs <?php echo $__env->yieldContent('title', ''); ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta content="" name="description" />
      <meta content="" name="author" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>" />
      <!-- App css -->
      <link href="<?php echo e(asset('assets/css/bootstrap.min.css?v=1.0')); ?>" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
      <link href="<?php echo e(asset('assets/css/app.min.css?v=' . filemtime(public_path('assets/css/app.min.css')))); ?>" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
      <link href="<?php echo e(asset('assets/css/bootstrap-dark.min.css?v=1.0')); ?>" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
      <link href="<?php echo e(asset('assets/css/app-dark.min.css?v=1.0')); ?>" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
      <!-- icons -->
      <link href="<?php echo e(asset('assets/css/icons.min.css?v=1.0')); ?>" rel="stylesheet" type="text/css" />

      <link href="<?php echo e(asset('assets/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />


      <!-- Toaster CSS -->
      <link href="<?php echo e(asset('assets/css/toastr.css?v=1.0')); ?>" rel="stylesheet" />
      <style>
         a:hover{text-decoration:none !important}
      </style>

      <?php echo $__env->yieldPushContent('css'); ?>
      <?php if(isset($slot)): ?>
         <!-- Scripts -->
         <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
         <!-- Styles -->
         <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

      <?php endif; ?>

      <script src="<?php echo e(asset('assets/js/jquery-3.7.1.min.js?v=1.0')); ?>"></script>

      <!-- JS -->
      <script src="<?php echo e(asset('assets/js/toastr.js?v=1.0')); ?>"></script>

      <script>
      $(document).ready(function() {
        <?php if(Session::has('message')): ?>
         toastr.options =
           {
            "closeButton" : true,
            "progressBar" : true
           }
            toastr.success("<?php echo e(session('message')); ?>");
         <?php endif; ?>

        <?php if(Session::has('error')): ?>
           toastr.options =
              {
               "closeButton" : true,
               "progressBar" : true
              }
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>

        <?php if(Session::has('info')): ?>
           toastr.options =
              {
               "closeButton" : true,
               "progressBar" : true
              }
            toastr.info("<?php echo e(session('info')); ?>");
        <?php endif; ?>

        <?php if(Session::has('warning')): ?>
        toastr.options =
           {
            "closeButton" : true,
            "progressBar" : true
           }
          toastr.warning("<?php echo e(session('warning')); ?>");
        <?php endif; ?>
      });
</script>


   </head>
   <!-- body start -->
   <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
      <!-- Begin page -->
      <div id="wrapper">
         <!-- Topbar Start -->
         <?php echo $__env->make('partials/top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <!-- end Topbar -->
         <!-- ========== Left Sidebar Start ========== -->

        <?php
            $roles = get_roles();
        ?>
            
        <?php if(in_array('super_admin', $roles) OR in_array('admin_view', $roles)): ?>
        <?php echo $__env->make('partials/left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('doit', $roles)): ?>
        <?php echo $__env->make('partials/doit-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('vendor', $roles)): ?>
        <?php echo $__env->make('partials/vendor-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('startup_msme', $roles)): ?>
        <?php echo $__env->make('partials/startup-msmeleft-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('institute', $roles)): ?>
        <?php echo $__env->make('partials/institute-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('bsnl-admin', $roles)): ?>
        <?php echo $__env->make('partials/bsnl-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('bsnl-user', $roles)): ?>
        <?php echo $__env->make('partials/user-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('expert-user', $roles)): ?>
        <?php echo $__env->make('partials/user-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('six-g-user', $roles)): ?>
        <?php echo $__env->make('partials/user-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('user', $roles)): ?>
        <?php echo $__env->make('partials/user-left-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('project_manager', $roles)): ?>
        <?php echo $__env->make('partials/telecom_project', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php elseif(in_array('lsa', $roles) OR in_array('nodal', $roles)): ?>
        <?php echo $__env->make('partials/lsa-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php else: ?>

        <?php endif; ?>
         
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start Page Content here -->
         <!-- ============================================================== -->
         <?php echo $__env->yieldContent('content'); ?>
         <?php if(isset($slot)): ?>
            <div class="content-page">
               <div class="content">
                   <!-- Start Content-->
                      <?php echo e($slot); ?>

               </div>
            </div>
         <?php endif; ?>

         <p class="text-center">Copyright &copy; <?php echo e(date('Y')); ?> Telecommunications Consultants India Limited</p>
         <!-- ============================================================== -->
         <!-- End Page content -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <!-- Right Sidebar -->
      <?php echo $__env->make('partials/right-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- /Right-bar -->
      <!-- Right bar overlay-->

      <!-- Vendor js -->
      <script src="<?php echo e(asset('assets/js/vendor.min.js?v=1.0')); ?>"></script>
      <!-- App js-->
      <script src="<?php echo e(asset('assets/js/app.min.js?v=1.0')); ?>"></script>

      <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
      <!--<script src="<?php echo e(asset('assets/js/main.js?v=1.1')); ?>"></script>-->

            <script src="<?php echo e(asset('assets/js/jquery-3.2.1.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/bootstrap/js/popper.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/bootstrap/js/bootstrap.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/fullpage/scroll-overflow.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/wow/wow.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/fullpage/fullpage.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/js/parallax.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/particale/particles.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/particale/app.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/owl-carousel/owl.carousel.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/owl-carousel/owlcarouselthumbs.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/slick/slick.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets/vendors/magnify-popup/jquery.magnific-popup.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

      <?php if(isset($slot)): ?>
         <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

      <?php endif; ?>

   </body>

   <script>
      $(document).on('click', '.close', function() {
         $(this).parent().parent().parent().parent().modal('hide');
    });
   </script>

<script>

$(document).ready(function() {
    $('#equipments').select2;
});

$(document).ready(function() {
    $('.view-data-btn').on('click', function() {
        //console.log('hello');
        var dataId = $(this).data('id');

        var baseUrl = "<?php echo e(url('/')); ?>";

        
        var url = baseUrl + '/modal-form/' +dataId;

       
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                
                $('#exampleModalCenter .modal-body').html(response);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });
});


</script>
</html>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/layouts/app.blade.php ENDPATH**/ ?>