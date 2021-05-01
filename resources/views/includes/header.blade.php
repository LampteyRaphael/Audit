<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('photos/logo 2.png')}}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Apostolic Church Management System(Ghana)</title>
    {{--<link rel="stylesheet" href="{{asset('styles/climacons-font.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('vendor/rickshaw/rickshaw.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('vendor/bootstrap/dist/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('vendor/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/jquery.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('styles/roboto.css')}}">
    <link rel="stylesheet" href="{{asset('styles/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('styles/panel.css')}}">
    <link rel="stylesheet" href="{{asset('styles/feather.css')}}">
    <link rel="stylesheet" href="{{asset('styles/animate.css')}}">
    <link rel="stylesheet" href="{{asset('styles/urban.css')}}">
    <link rel="stylesheet" href="{{asset('styles/urban.skins.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.4-dist/css/bootstrap.min.css')}}">
    <script src="{{asset('jquery-3.4.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('bootstrap-select-1.13.9/dist/css/bootstrap-select.css')}}">
    <script src="{{asset('bootstrap-notify-3.1.3/dist/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js')}}"></script>

    <style type="text/css">
        body{
            font-family:Roboto;
            font-size: 12px;
        }
        .breadcrumb{
            font-size: 13px;
            font-weight: bold;
            font-family: Roboto;
        }
        .breadcrumb > li{
            padding: 0px 0px;
            font-size: 15px;
            color: #2e1280;
            font-weight: bold;
        }

        .breadcrumb > li + li::before {
            padding: 0px 0px;
            font-size: 15px;
            color: blue;
            font-weight: bold;
            content: "\f105\00a0";
        }

        .panel-heading{
            padding: 0px;
            background-color:#f1f1f1;
            color: blue;
            font-family: Roboto;
            font-weight: bold;
            font-size: 12px;
        }

        .breadcrumb{
            background:-webkit-gradient(linear, left bottom, left top, color-stop(0, #dddddd), color-stop(1, #fdfdfd));
        }

        .shadow{
           box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1), 0 5px 5px 0 rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body data-spy="scroll" data-target="#affix" >
