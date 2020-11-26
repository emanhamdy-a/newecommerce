<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ !empty($title)?$title:trans('admin.adminpanel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  @if(direction() == 'ltr')
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/jstree/default/style.css">
  <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
  @else
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/dist/css/rtl/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/dist/css/rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/dist/css/rtl/rtl.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/dist/css/fonts/cairo.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/jstree/default/style.css">
  <link rel="stylesheet" href="{{ url('/') }}/css/stylertl.css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Cairo:300,400&amp;subset=arabic,latin-ext" rel="stylesheet"> -->
  <style type="text/css">
    html,body,h1,h2,h3,h4,h5,h6,a,span,li,ul,.alert{
      font-family: 'cairo';
    }
  </style>
  @endif
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to
       reduce the load. -->
  <!-- this change the theme colors-->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/dist/css/skins/_all-skins.css">

  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/select2/select2.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/Adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">




  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">


  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">




</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
