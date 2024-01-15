<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! SEO::generate() !!}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">




    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/site.webmanifest')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @livewireStyles

</head>
<body>
<div class="wrapper">
    {{--    <div class="preloader"></div>--}}

    <!-- Main Header Nav -->
    @include('main-header')

    <!-- Main Header Nav For Mobile -->
    <div id="page" class="stylehome1 h0">
        <div class="mobile-menu">
            <div class="header stylehome1">
                <div class="main_logo_home2 text-center"><img class="nav_logo_img img-fluid mt10"
                                                              src="{{asset('images/logo-light.svg')}}"
                                                              width="50%"
                                                              alt="header-logo.svg">
                </div>
                <ul class="menu_bar_home2">
                    <li class="list-inline-item"><a class="custom_search_with_menu_trigger msearch_icon" href="#"></a>
                    </li>
                    <li class="list-inline-item"><a class="muser_icon" href="#" data-toggle="modal"
                                                    data-target="#logInModal"><span class="flaticon-user"></span></a>
                    </li>
                    <li class="list-inline-item"><a class="menubar" href="#menu"><span></span></a></li>
                </ul>
            </div>
        </div>
        <!-- /.mobile-menu -->
        <nav id="menu" class="stylehome1">
            <ul>
                <li><a href="{{route('home')}}">Home</a>
                <li><a href="{{route('houses.index')}}">Properties</a></li>
                <li><a href="{{route('cars.index')}}">Cars</a></li>
                <li><a href="{{route('lands.index')}}">Lands</a></li>
                <li><a href="{{route('hotels.index')}}">Hotels</a></li>
                <li><a href="{{route('fashions.index')}}">Fashions</a></li>
                <li class="cl_btn"><a class="btn btn-block btn-lg btn-thm rounded" href="{{route('register')}}">
                        <span
                            class="icon flaticon-button mr5"></span> Create Listing</a></li>
            </ul>
        </nav>
    </div>

    {{$slot}}

    <!-- Our Footer -->
    @include('footer')
    <a class="scrollToHome" href="#"><i class="fa fa-angle-up"></i></a></div>


@livewireScripts


<script>
    $(document).ready(function () {
        $('.select2').select2();

    });

</script>
<script>

    window.addEventListener('render-select2', event => {
        console.log('Some data has been received!');
        $('.select2').select2();
    })
</script>

<style>
    body {
        color: #000150;
    }
</style>
@stack('scripts')
<!-- Wrapper End -->
{{--<script src="{{asset('js/jquery-3.6.0.js')}}"></script>--}}
<script src="{{asset('js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/isotop.js')}}"></script>
<script src="{{asset('js/snackbar.min.js')}}"></script>
<script src="{{asset('js/simplebar.js')}}"></script>
<script src="{{asset('js/parallax.js')}}"></script>
<script src="{{asset('js/scrollto.js')}}"></script>
<script src="{{asset('js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('js/jquery.counterup.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/progressbar.js')}}"></script>
<script src="{{asset('js/slider.js')}}"></script>
<script src="{{asset('js/pricing-slider.js')}}"></script>
<script src="{{asset('js/timepicker.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<!-- Custom script for all pages -->
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/api_call.js')}}"></script>
<script src="{{asset('js/momo_payment.js')}}"></script>
</body>
</html>
