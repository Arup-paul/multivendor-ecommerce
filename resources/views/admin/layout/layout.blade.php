<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ecommerce Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
     @include('admin.layout.css')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
{{--         header section --}}
        @include('admin.layout.header')

         {{--        Sidebar --}}
        @include('admin.layout.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        @include('admin.layout.footer')
