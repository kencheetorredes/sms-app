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
                <div class="login-inbox admin-login">
                    <div class="log-auth">
                        <div class="login-auth-wrap">
                            <div class="login-content-head">
                                <h3>Login</h3>
                            </div>
                        </div>
                        <form action="{{route('auth.process','login')}}" method="post">
                        @if(session('error'))
                <div class="alert alert-danger alert-msg">{{ session('error') }} </div>
                @endif
                @error('email') <div class="alert alert-msg alert-danger">{{ $message }}</div> @enderror
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Email  <span>*</span></label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password <span>*</span></label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="form-control pass-input">
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            <div class="form-group form-remember d-flex align-items-center justify-content-between">
                                <span class="forget-pass">
                                    <a href="{{route('auth.forgot')}}">
                                        Forgot Password
                                    </a>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-size justify-content-center">Login</button>
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
