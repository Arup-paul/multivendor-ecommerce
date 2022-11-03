<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biolife - Organic Food</title>
     @include('frontend.layouts.css')

</head>
<body class="biolife-body">

    <!-- Preloader --> 

     @include('frontend.layouts.header')

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">

           @yield('content')
        </div>

    </div>

 
    @include('frontend.layouts.footer')
    @include('frontend.layouts.scripts')
</body>

</html>