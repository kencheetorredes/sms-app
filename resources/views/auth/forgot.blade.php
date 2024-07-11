<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<title>Hiras SMS</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/img/logo-new.png')}}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{url('admin/assets/css/bootstrap.min.css')}}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{url('admin/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{url('admin/assets/plugins/fontawesome/css/all.min.css')}}">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="{{url('admin/assets/css/feather.css')}}">

	<!-- Main CSS -->
    <link rel="stylesheet" href="{{url('admin/assets/css/style.css')}}">

</head>

<body class="login-form">

	<!-- Main Wrapper -->
	<div class="main-wrapper register-surv">
        <div class="container-fluid">
            <div class="login-wrapper">
                <header class="logo-header">
                    <a href="/" class="logo-brand">
                        <img src="{{url('assets/img/logo-new.png')}}" alt="Logo" class="img-fluid logo-dark">
                    </a>
                </header>
                <div class="login-inbox">
                    <div class="log-auth">
                        <div class="login-auth-wrap">
                            <div class="login-content-head">
                                <h3>Forgot Password</h3>
                                <p>Enter your email to get a password reset link</p>
                            </div>
                        </div>
                        <form action="reset-password.html">
                            <div class="form-group">
                                <label class="form-label">Email <span>*</span></label>
                                <input class="form-control" id="email" name="email" type="text">
                            </div>                          
                            <button type="submit" class="btn btn-primary w-100 btn-size justify-content-center mb-3">Reset Password</button>     
                            <div class="bottom-text">
                                <p>Remember your password?  <a href="{{route('auth.index')}}">Login</a></p>
                            </div>                      
                        </form>
                    </div>
                </div>                
            </div>            
        </div>
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{url('assets/js/jquery-3.7.0.min.js')}}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>

	<!-- Custom JS -->
	<script src="{{url('assets/js/script.js')}}"></script>


</body>
</html>
