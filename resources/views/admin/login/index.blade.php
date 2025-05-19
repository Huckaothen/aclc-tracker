<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ACLC Alumni Tracker System - Admin Panel">
    <meta name="author" content="ACLC">
    <title>ACLC Alumni Tracker | Admin Login</title>
    
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('typicons.font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('azia.css') }}">

    <style>
        /* body {
            background: url("{{ asset('assets/images/cover.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
        } */
        body {
            background: #06286f;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .admin-login-card {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .admin-logo {
            width: 80px;
            margin-bottom: 10px;
        }
        .form-control {
            border-radius: 6px;
        }
        .btn-login {
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
        }
        .admin-footer {
            font-size: 14px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="admin-login-card">
        <img src="{{ asset('assets/images/logo-web.webp') }}" class="admin-logo" alt="ACLC Alumni Tracker">
        <h4 class="mb-3">Admin Panel Login</h4>
        
        <form action="{{ route('admin.auth') }}" method="POST" id="loginForm">
            @csrf
            <div class="form-group text-start">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group mt-3 text-start">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-danger btn-login mt-4" id="loginButton">
                Log In
            </button>
        </form>
    </div>

    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                let loginButton = $('#loginButton');
                let originalText = loginButton.html();

                $.ajax({
                    url: "{{ route('admin.auth') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        loginButton.prop('disabled', true).html('Logging in...'); // Show loading
                    },
                    success: function (response) {
                        if (response.success) {
                            window.location.href = "{{ route('admin.home') }}"; 
                        }
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = "Error:\n";

                        if (errors) {
                            $.each(errors, function (key, value) {
                                errorMsg += "- " + value[0] + "\n";
                            });
                        } else {
                            errorMsg += "- Invalid email or password. Please try again.";
                        }

                        alert(errorMsg);
                    },
                    complete: function () {
                        loginButton.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
</body>
</html>
