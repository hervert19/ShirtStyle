<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link type="text/css" href="{{ asset('/css/default/materialize.min.css?v='.rand()) }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/css/default/nouislider.css?v='.rand()) }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/css/default/style.css?v='.rand()) }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/css/default/sweetalert2.min.css?v='.rand()) }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">
        <title>{{$title}}</title>
    </head>

    <body>