<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ACLC Alumni Tracker - Login</title>
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('azia.css') }}">

    <style>
        body {
            background: url("{{ asset('assets/images/aclc-logo.jpg') }}") no-repeat center center fixed;
            background-size: cover;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
        }
        .login-card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="login-container">
        <div class="card login-card p-4">
            <div class="card-header text-center bg-primary text-white">
                <h3>ACLC Alumni Tracker</h3>
                <p class="mb-0">Login to Your Account</p>
            </div>

            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/images/login-logo.png') }}" width="150" alt="ACLC Logo">
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form id="loginForm" name="loginForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="******" required>
                    </div>

                    <button type="submit" id="loginBtn" class="btn btn-primary w-100">Login</button>
                </form>
            </div>

            <div class="card-footer text-center">
                <p class="mb-0">Don't have an account? <a href="{{ route('alumni.register') }}">Register</a></p>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-4">
    <p class="mb-0">© {{ date('Y') }} ACLC Alumni Tracker System. All rights reserved.</p>
</footer>
<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    $(document).ready(function () {
      $("#loginForm").on("submit", function (e) {
          e.preventDefault();

          let formData = $(this).serialize();

          $.ajax({
              url: "{{ route('alumni.auth') }}",
              type: "POST",
              data: formData,
              dataType: "JSON",
              beforeSend: function () {
                  $("#loginBtn").text("Logging in...").prop("disabled", true);
                  $(".error").remove();
              },
              success: function (response) {
                  if (response.success) {
                    $("#loginBtn").text("Login").prop("disabled", false);
                    alert(response.message);
                    window.location.href = "{{route('alumni.home')}}"
                  }
              },
              error: function (xhr) {
                  $("#loginBtn").text("Login").prop("disabled", false);

                  let res = xhr.responseJSON;
                  if (res.errors) {
                      $.each(res.errors, function (key, value) {
                          $("#" + key).after("<span class='text-danger error'>" + value[0] + "</span>");
                      });
                  } else if (res.message) {
                      alert(res.message);
                  }
              }
          });
      });
  });
</script>

</body>
</html>
