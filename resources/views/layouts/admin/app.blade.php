
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ACLC Alumni Tracker System">
    <meta name="author" content="ACLC">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ACLC-ATS - App')</title>
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('typicons.font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('morris.js/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('azia.css') }}">
    @if(in_array(request()->route()->getName(), [
      'admin.alumni',
      'admin.career',
      'admin.event',
      'admin.announcement',
      'admin.forum',
      'admin.user'
  ]))
    <link rel="stylesheet" href="{{ asset('datatables.net-dt/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables.net-dt/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
    @if (request()->routeIs('admin.career') || request()->routeIs('admin.event') || request()->routeIs('admin.announcement') || request()->routeIs('admin.forum'))
      <link rel="stylesheet" href="{{ asset('quill.snow/quill.snow.css') }}">
    @endif
    @endif
  </head>
  <body class="az-body az-body-sidebar">
    @include('layouts.admin.sidebar')
    <div class="az-content az-content-dashboard-two">
        @include('layouts.admin.header')
        @yield('content')
        @include('layouts.admin.footer')
    </div>

    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('azia.js') }}"></script>
   
    @if(in_array(request()->route()->getName(), [
        'admin.alumni',
        'admin.career',
        'admin.event',
        'admin.announcement',
        'admin.forum',
        'admin.user'
    ]))
      <script src="{{ asset('datatables.net-dt/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
      <script src="{{ asset('datatables.net-dt/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('datatables.net-dt/js/responsive.dataTables.min.js') }}"></script>
      <script src="{{ asset('select2/select2.min.js') }}"></script>
      @if(request()->routeIs('admin.alumni'))
      <script src="{{ asset('custom/admin.alumni.js') }}"></script>
      @endif
      @if(request()->routeIs('admin.career'))
      <script src="{{ asset('quill.snow/quill.min.js') }}"></script>
      <script src="{{ asset('custom/admin.career.js') }}"></script>
      @endif
      @if(request()->routeIs('admin.event'))
      <script src="{{ asset('quill.snow/quill.min.js') }}"></script>
      <script src="{{ asset('custom/admin.event.js') }}"></script> 
      @endif
      @if(request()->routeIs('admin.announcement'))
      <script src="{{ asset('quill.snow/quill.min.js') }}"></script>
      <script src="{{ asset('custom/admin.announcement.js') }}"></script>
      @endif
      @if(request()->routeIs('admin.forum'))
      <script src="{{ asset('quill.snow/quill.min.js') }}"></script>
      <script src="{{ asset('custom/admin.forum.js') }}"></script>
      @endif
      @if(request()->routeIs('admin.user'))
      <script src="{{ asset('custom/admin.user.js') }}"></script>
      @endif
    @endif
   
      <script>
        $(function(){
          'use strict';
          
          $('.az-sidebar .with-sub').on('click', function(e){
              e.preventDefault();
              $(this).parent().toggleClass('show');
              $(this).parent().siblings().removeClass('show');
          });

          $(document).on('click touchstart', function(e){
            e.stopPropagation();

            if(!$(e.target).closest('.az-header-menu-icon').length) {
              var sidebarTarg = $(e.target).closest('.az-sidebar').length;
              if(!sidebarTarg) {
                $('body').removeClass('az-sidebar-show');
              }
            }
          });

          $('#azSidebarToggle').on('click', function(e){
            e.preventDefault();

            if(window.matchMedia('(min-width: 992px)').matches) {
              $('body').toggleClass('az-sidebar-hide');
            } else {
              $('body').toggleClass('az-sidebar-show');
            }
          })
        });
      </script>
      @yield('scripts')
  </body>
</html>
