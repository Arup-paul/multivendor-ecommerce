
    <script src="{{asset('frontend/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.countdown.min.js')}}"></script>
{{--    <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>--}}
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <script src="{{asset('frontend/assets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/biolife.framework.js')}}"></script>
    <script src="{{asset('frontend/assets/js/functions.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugin/toastifyjs/toastify.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugin/sweetalert/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugin/Notify.js')}}"></script>
    <script src="{{asset('frontend/assets/js/form.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom.js')}}"></script>

    @yield('frontend_scripts')
    @stack('frontend_scripts')
