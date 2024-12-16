<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Add background with reduced opacity */
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/bgimg.jpg') no-repeat center center;
            background-size: cover;
            opacity: 0.6;
            /* Adjusted opacity for background overlay */
            z-index: -1;
        }

        /* Ensure the login card looks similar to the registration card */
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 500px;
            /* Adjust width to match the registration card */
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Card background with reduced opacity */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* Add same box shadow */
        }

        /* Add box shadow and border radius to form fields */
        .form-control {
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
        }

        /* Button border radius */
        .btn {
            border-radius: 8px;
            font-weight: 600;
        }

        h3 {
            font-weight: 600;
            color: #333;
        }

        .text-center img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <!-- Background Overlay -->
    <div class="bg-overlay"></div>

    <!-- Login Form Section -->
    <section class="py-5 login-container">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow p-4">
                <!-- Logo above the form -->
                <div class="text-center mb-4">
                    <img src="assets/sblogo.jpg" alt="Logo">
                </div>

                <h3 class="text-center mb-4">Login</h3>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error_message; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-4">Login</button>
                </form>
                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="registration.php" class="text-decoration-none">Sign up</a></small>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>