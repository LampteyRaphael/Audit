{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <title>{{ __('TACMS') }}</title>--}}
{{--    <link rel="apple-touch-icon" sizes="76x76" href="{{'logo/logo 2.png'}}">--}}
{{--    <link rel="icon" type="image/png" href="{{'logo/logo 2.png'}}">--}}
{{--    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />--}}
{{--    <!--     Fonts and icons     -->--}}
{{--    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">--}}
{{--    <!-- CSS Files -->--}}
{{--    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />--}}
{{--    <!-- CSS Just for demo purpose, don't include it in your project -->--}}
{{--    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />--}}
{{--</head>--}}
{{--<body class="{{ $class ?? '' }}">--}}
{{--<div class="container">--}}
{{--    <div id="app">--}}
{{--        <product></product>--}}
{{--        <example-component></example-component>--}}
{{--        <foot></foot>--}}
{{--        <mainapp></mainapp>--}}
{{--        <mainfooter></mainfooter>--}}

{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{mix('/js/app.js')}}"></script>--}}




{{--</body>--}}
{{--</html>--}}


<?php

// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON What would you want to check \n";
    $response .= "1. My Account \n";
    $response .= "2. My phone number";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Account number \n";
    $response .= "2. Account balance";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Your phone number is ".$phoneNumber;

} else if($text == "1*1") {
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your account number is ".$accountNumber;

} else if ( $text == "1*2" ) {
    // This is a second level response where the user selected 1 in the first instance
    $balance  = "KES 10,000";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your balance is ".$balance;
}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;


?>
