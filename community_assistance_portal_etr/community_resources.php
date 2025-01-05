<?php
// community_resources.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Community Resources Listing">
    <meta name="author" content="Your Name">
    <title>Community Resources</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
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
                    <li class="nav-item">
                        <!-- Red logout link -->
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Community Resources</h1>
        <p class="text-center text-muted mb-5">Access helpful resources available in our community.</p>

        <!-- Community Resources List -->
        <div class="list-group">
            <!-- Resource 1 -->
            <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                <h5 class="mb-2 text-dark">Food Assistance Program</h5>
                <p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: Community Center</p>
                <p class="mb-2 text-muted"><i class="bi bi-telephone"></i> Contact: (123) 456-7890</p>
                <p class="mb-3">Provides food assistance to families in need every first Wednesday of the month.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
            </div>
            <!-- Resource 2 -->
            <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                <h5 class="mb-2 text-dark">Mental Health Support</h5>
                <p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: Health Clinic</p>
                <p class="mb-2 text-muted"><i class="bi bi-telephone"></i> Contact: (987) 654-3210</p>
                <p class="mb-3">Free counseling and mental health support services available to all residents.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
            </div>
            <!-- Resource 3 -->
            <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                <h5 class="mb-2 text-dark">Senior Citizens Assistance</h5>
                <p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: Senior's Hall</p>
                <p class="mb-2 text-muted"><i class="bi bi-telephone"></i> Contact: (555) 123-4567</p>
                <p class="mb-3">Offering programs for senior citizens, including health check-ups and recreational activities.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-outline-success px-5 py-3">Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>