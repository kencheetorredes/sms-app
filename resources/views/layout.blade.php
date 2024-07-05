<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="author" content="kenchee torredes">
	<title>DreamsChat</title>

    <!-- Favicon -->
    <link rel="icon" href="{{url('assets/img/favicon.png')}}">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">

    <!-- Feathericon CSS -->
	<link rel="stylesheet" href="{{url('assets/css/feather.css')}}">
	
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{url('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/fontawesome/css/all.min.css')}}">

    <!-- Swiper CSS -->
	<link rel="stylesheet" href="{{url('assets/plugins/swiper/swiper.min.css')}}">

    <!-- FancyBox CSS -->
    <link rel="stylesheet" href="{{url('assets/plugins/fancybox/jquery.fancybox.min.css')}}">

    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{url('assets/plugins/boxicons/css/boxicons.min.css')}}">

    <!-- Select CSS -->
    <link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{url('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{url('common/custom.css')}}">
    @yield('css')
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
	
        <!-- content -->
        <div class="content main_content">

            <!-- Left Sidebar Menu -->
            @include('common.side')
            <!-- /Left Sidebar Menu -->
            @yield('content')
        </div> 
        <!-- /Content -->

    </div>
    @include('common.modal')
    <!-- /Main Wrapper -->
	
	<!-- jQuery -->
    <script src="{{url('assets/js/jquery-3.7.0.min.js')}}"></script>
        
    <!-- Bootstrap Core JS -->
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
	
	<!-- Slimscroll JS -->
    <script src="{{url('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Swiper JS -->
	<script src="{{url('assets/plugins/swiper/swiper.min.js')}}"></script>

    <!-- FancyBox JS -->
    <script src="{{url('assets/plugins/fancybox/jquery.fancybox.min.js')}}"></script>

    <!-- Select JS -->
    <script src="{{url('assets/plugins/select2/js/select2.min.js')}}"></script>

	<!-- Custom JS -->
    <script src="{{url('assets/js/script.js')}}"></script> 
    <script src="{{ url('common/js/swal.js') }}"></script>
	<script src="{{ url('common/js/bootstrap-table.js') }}"></script>
    <script src="{{ url('common/js/common.js') }}"></script>
    <script src="{{ url('common/js/init/select_modal2.js') }}"></script>
	@yield('js')
</body>
</html>