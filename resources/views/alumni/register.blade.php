<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ACLC Alumni Tracker - Register</title>
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
        .register-container {
            max-width: 600px;
            margin: 50px auto;
        }
        .register-card {
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
    <div class="register-container">
        <div class="card register-card p-4">
            <div class="card-header text-center bg-primary text-white">
                <h3>ACLC Alumni Tracker</h3>
                <p class="mb-0">Register as an Alumni</p>
            </div>

            <div class="card-body">
                <form id="registerForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="college_id" class="form-label">College ID</label>
                        <input type="text" name="college_id" id="college_id" class="form-control" placeholder="e.g c11-01-*****-man121" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="e.g johndoe@gmail.com" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="******" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="e.g John Doe" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control" placeholder="e.g 09157******" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select name="civil_status" id="civil_status" class="form-control">
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widowed">Widowed</option>
                                <option value="divorced">Divorced</option>
                                <option value="separated">Separated</option>
                                <option value="annulled">Annulled</option>
                            </select>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="batch" class="form-label">Year Graduated</label>
                            <select name="batch" id="batch" class="form-control">
                                @for ($year = 2005; $year <= 2050; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="graduated_course" class="form-label">Graduated Course</label>
                            <select name="graduated_course" id="graduated_course" class="form-control">
                                @foreach($courses as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="employability_status" class="form-label">Employability Status</label>
                            <select name="employability_status" id="employability_status" class="form-control">
                                <option value="employed">Employed</option>
                                <option value="self_employed">Self-Employeed</option>
                                <option value="unemployed">Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" placeholder="e.g 70012 Sitio Balimbing mandaue city, cebu" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Currently Employed At</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="e.g Accenture">
                    </div>

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" id="registerBtn" class="btn btn-primary w-100">Register</button>
                </form>
            </div>

            <div class="card-footer text-center">
                <p class="mb-0">Already have an account? <a href="{{ route('alumni.login') }}">Sign in</a></p>
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
        $("#registerForm").on("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('alumni.create.account') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#registerBtn").text("Processing...").prop("disabled", true);
                },
                success: function (response) {
                    alert(response.message);
                    $("#registerBtn").text("Register").prop("disabled", false);
                    setTimeout(() => {
                      window.location.reload(true);
                    }, 2000);
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    $(".error").remove();
                    $.each(errors, function (key, value) {
                        $("#" + key).after("<span class='text-danger error'>" + value[0] + "</span>");
                    });
                    $("#registerBtn").text("Register").prop("disabled", false);
                }
            });
        });
    });
</script>

</body>
</html>
