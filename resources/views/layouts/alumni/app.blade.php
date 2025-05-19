<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ACLC Alumni Tracker">
    <meta name="author" content="ACLC">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ACLC Alumni Tracker System')</title>
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('typicons.font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('azia.css') }}">
    <link rel="stylesheet" href="{{ asset('quill.snow/quill.snow.css') }}">
  </head>
  <body>
  @include('layouts.alumni.header')
  @yield('content')
  @include('layouts.alumni.footer')
</body>
</html>
