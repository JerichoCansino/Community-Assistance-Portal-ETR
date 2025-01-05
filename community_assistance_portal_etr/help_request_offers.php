<?php
// help_request_offers.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Help Requests and Offers">
    <meta name="author" content="Your Name">
    <title>Help Requests and Offers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Santa Barbara Community Assistance Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-success text-center mb-4">Help Requests and Offers</h1>
        <p class="text-center">Collaborate with your community by requesting help or offering assistance.</p>

        <div class="row">
            <!-- Request Help -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Request Help</h4>
                    </div>
                    <div class="card-body">
                        <form action="process_help_request.php" method="POST">
                            <div class="mb-3">
                                <label for="requestName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="requestName" name="requestName" required>
                            </div>
                            <div class="mb-3">
                                <label for="requestContact" class="form-label">Contact Information</label>
                                <input type="text" class="form-control" id="requestContact" name="requestContact" required>
                            </div>
                            <div class="mb-3">
                                <label for="requestDetails" class="form-label">Details of Help Needed</label>
                                <textarea class="form-control" id="requestDetails" name="requestDetails" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Offer Help -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Offer Help</h4>
                    </div>
                    <div class="card-body">
                        <form action="process_help_offer.php" method="POST">
                            <div class="mb-3">
                                <label for="offerName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="offerName" name="offerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="offerContact" class="form-label">Contact Information</label>
                                <input type="text" class="form-control" id="offerContact" name="offerContact" required>
                            </div>
                            <div class="mb-3">
                                <label for="offerDetails" class="form-label">Details of Assistance Offered</label>
                                <textarea class="form-control" id="offerDetails" name="offerDetails" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Offer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-outline-secondary">Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>