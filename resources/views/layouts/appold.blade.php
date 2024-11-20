<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Bharat 5G Labs @yield('title', '')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta content="" name="description" />
      <meta content="" name="author" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
      <!-- App css -->
      <link href="{{ asset('assets/css/bootstrap.min.css?v=1.0') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
      <link href="{{ asset('assets/css/app.min.css?v=' . filemtime(public_path('assets/css/app.min.css'))) }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
      <link href="{{ asset('assets/css/bootstrap-dark.min.css?v=1.0') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
      <link href="{{ asset('assets/css/app-dark.min.css?v=1.0') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
      <!-- icons -->
      <link href="{{ asset('assets/css/icons.min.css?v=1.0') }}" rel="stylesheet" type="text/css" />

      <!-- Toaster CSS -->
      <link href="{{ asset('assets/css/toastr.css?v=1.0') }}" rel="stylesheet" />

      <style>
         a:hover{text-decoration:none !important}
      </style>

      @stack('css')

      @if(isset($slot))

         <!-- Scripts -->
         @vite(['resources/css/app.css', 'resources/js/app.js'])

         <!-- Styles -->
         @livewireStyles

      @endif


      <script src="{{ asset('assets/js/jquery-3.7.1.min.js?v=1.0') }}"></script>

      <!-- JS -->
      <script src="{{ asset('assets/js/toastr.js?v=1.0') }}"></script>

      <script>
      $(document).ready(function() {
        @if(Session::has('message'))
         toastr.options =
           {
            "closeButton" : true,
            "progressBar" : true
           }
            toastr.success("{{ session('message') }}");
         @endif

        @if(Session::has('error'))
           toastr.options =
              {
               "closeButton" : true,
               "progressBar" : true
              }
            toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
           toastr.options =
              {
               "closeButton" : true,
               "progressBar" : true
              }
            toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
           {
            "closeButton" : true,
            "progressBar" : true
           }
          toastr.warning("{{ session('warning') }}");
        @endif
      });
</script>


   </head>
   <!-- body start -->
   <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
      <!-- Begin page -->
      <div id="wrapper">
         <!-- Topbar Start -->
         @include('partials/top-bar')
         <!-- end Topbar -->
         <!-- ========== Left Sidebar Start ========== -->

        @php
            $roles = get_roles();
        @endphp
            
        @if(in_array('super_admin', $roles))
        @include('partials/left-side-bar')

        @elseif(in_array('doit', $roles))
        @include('partials/doit-left-side-bar')

        @elseif(in_array('vendor', $roles))
        @include('partials/vendor-left-side-bar')

        @elseif(in_array('startup_msme', $roles))
        @include('partials/startup-msmeleft-side-bar')

        @elseif(in_array('institute', $roles))
        @include('partials/institute-left-side-bar')

        @else

        @endif
         
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start Page Content here -->
         <!-- ============================================================== -->
         @yield('content')
         @if(isset($slot))
            <div class="content-page">
               <div class="content">
                   <!-- Start Content-->
                      {{ $slot }}
               </div>
            </div>
         @endif

         <p class="text-center">Copyright &copy; {{ date('Y') }} Telecommunications Consultants India Limited</p>
         <!-- ============================================================== -->
         <!-- End Page content -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <!-- Right Sidebar -->
      @include('partials/right-side-bar')
      <!-- /Right-bar -->
      <!-- Right bar overlay-->

      <!-- Vendor js -->
      <script src="{{ asset('assets/js/vendor.min.js?v=1.0') }}"></script>
      <!-- App js-->
      <script src="{{ asset('assets/js/app.min.js?v=1.0') }}"></script>
      <!--<script src="{{ asset('assets/js/main.js?v=1.1') }}"></script>-->

      @if(isset($slot))
         @livewireScripts
      @endif

   </body>

   <script>
      $(document).on('click', '.close', function() {
         $(this).parent().parent().parent().parent().modal('hide');
    });
   </script>
</html>
@stack('scripts')
