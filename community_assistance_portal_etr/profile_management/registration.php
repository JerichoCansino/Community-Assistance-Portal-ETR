<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background image with opacity */
        .bg-overlay {
            background: url('assets/bgimg.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1;
            opacity: 0.6;
            /* Adjust the opacity */
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            /* White background with slight transparency for the form */
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <!-- Background Overlay -->
    <div class="bg-overlay"></div>

    <!-- Registration Form Section -->
    <section class="py-5">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; border-radius: 12px;">
                <!-- Logo above the form -->
                <div class="text-center mb-4">
                    <img src="assets/sblogo.jpg" alt="Logo" width="80" height="80">
                </div>

                <h3 class="text-center mb-4" style="font-weight: 600; color: #333;">Create an Account</h3>
                <form action="register_handler.php" method="POST">
                    <!-- Full Name and Email Row -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <!-- Username, Password, and Confirm Password Row -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password" required>
                        </div>
                    </div>
                    <!-- Age, Sex, and Address Row -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Sex</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" id="male" name="sex" value="Male" required>
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="female" name="sex" value="Female" required>
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                    </div>

                    <!-- Confirm Password Row -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <!-- Sign Up Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success w-100">Sign Up</button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-3">
                    <small>Already have an account? <a href="login.php" class="text-decoration-none">Log in</a></small>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>