<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-body i {
            font-size: 2.25rem;
        }

        .card {
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar (Login and Sign Up removed) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Sta. Barbara Community Assistance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Banner Image -->
    <section class="hero text-center py-5" style="position: relative; background-image: url('assets/banner.jpg'); background-size: cover; background-position: center;">
        <!-- Darker Overlay with low opacity -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7);"></div>

        <div class="container text-white position-relative">
            <h1 class="display-4 font-weight-bold">Welcome to Sta. Barbara Community Assistance Portal</h1>
            <p class="lead font-weight-bold">Your gateway to managing everything efficiently and easily!</p>

            <!-- Login and Sign Up Buttons (moved here) -->
            <div class="mt-4">
                <a class="btn btn-success text-white" href="profile_management/login.php">Login</a>
                <a class="btn btn-outline-light text-white ms-2" href="profile_management/registration.php">Sign Up</a>
            </div>
        </div>
    </section>

    <!-- How Can We Help? Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Services Offered</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Event Listing Tile -->
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-calendar-event text-success"></i>
                            <h5 class="card-title mt-3">Community Events</h5>
                            <p class="card-text">Stay updated with community events and activities.</p>
                            <a href="community_events.php" class="btn btn-outline-success">Explore</a>
                        </div>
                    </div>
                </div>

                <!-- Community Resources Tile -->
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-house-door text-primary"></i>
                            <h5 class="card-title mt-3">Community Resources</h5>
                            <p class="card-text">Access resources for your community needs.</p>
                            <a href="community_resources.php" class="btn btn-outline-primary">View Resources</a>
                        </div>
                    </div>
                </div>

                <!-- Quick Access to Emergency Services Tile -->
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-exclamation-circle text-danger"></i>
                            <h5 class="card-title mt-3">Emergency Services</h5>
                            <p class="card-text">Get quick access to essential emergency contacts.</p>
                            <a href="emergency_services.php" class="btn btn-outline-danger">Access Now</a>
                        </div>
                    </div>
                </div>

                <!-- Help Requests and Offers Tile -->
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-hand-thumbs-up" style="color: #6f42c1;"></i> <!-- Added Icon -->
                            <h5 class="card-title mt-3">Help Requests and Offers</h5>
                            <p class="card-text">Connect with others for help or to offer assistance.</p>
                            <a href="help_request_offers.php" class="btn btn-outline-secondary" style="color: #6f42c1; border-color: #6f42c1;">Find Help</a>
                        </div>
                    </div>
                </div>


                <!-- Feedbacks and Ratings Tile -->
                <div class="col">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-star text-warning"></i>
                            <h5 class="card-title mt-3">Feedbacks and Ratings</h5>
                            <p class="card-text">Share and view feedback about services and events.</p>
                            <a href="feedbacks_ratings.php" class="btn btn-outline-warning">Give Feedback</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">About Us</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <!-- Green Icon -->
                            <i class="bi bi-speedometer2 display-4 text-success"></i>
                            <h5 class="card-title mt-3">Fast Performance</h5>
                            <p class="card-text">Experience lightning-fast operations with our optimized platform.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <!-- Green Icon -->
                            <i class="bi bi-shield-lock display-4 text-success"></i>
                            <h5 class="card-title mt-3">Secure</h5>
                            <p class="card-text">Your data is safe with us, thanks to our advanced security measures.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <!-- Green Icon -->
                            <i class="bi bi-people display-4 text-success"></i>
                            <h5 class="card-title mt-3">User-Friendly</h5>
                            <p class="card-text">Our platform is designed with simplicity and ease of use in mind.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-2">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
        <p class="mb-1">Follow us on:</p>
        <div>
            <a href="https://www.facebook.com" target="_blank" class="btn btn-outline-light btn-sm">
                <i class="bi bi-facebook"></i> Facebook
            </a>
        </div>
        <p class="mt-2 mb-0">Contact us: <a href="mailto:info@sbcommunityportal.com" class="text-light">info@sbcommunityportal.com</a></p>
        <p class="mb-0">Phone: +1 (800) 123-4567</p>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>