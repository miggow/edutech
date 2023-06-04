<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edutech</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    {{-- <link href="{{asset('/template/css/all.min.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('assets/vendors/fontawesome/css/all.min.css')}}"/>
    <!-- Libraries Stylesheet -->
    <link href="{{asset('/template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('/template/css/style.min.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    @include('frontend.navbar')
    <!-- Navbar End -->
    <div class=" jumbotron-fluid position-relative overlay-bottom" style="margin-top: 120px;">

    </div>
    @yield('content')



    <!-- JavaScript Libraries -->
    <script src="{{asset('/template/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('/template/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/template/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('/template/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('/template/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('/template/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('/template/js/main.js')}}"></script>
</body>

</html>
