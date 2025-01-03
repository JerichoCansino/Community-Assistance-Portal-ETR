<?php
// emergency_services.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Emergency Services Contact Details">
    <meta name="author" content="Your Name">
    <title>Emergency Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
                        <a class="nav-link text-danger" href="logout.php">Logout</a> <!-- Logout button changed to red -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-danger text-center mb-4">Emergency Services</h1>
        <p class="text-center">Find essential contact details for emergency services in your area.</p>

        <!-- Emergency Contacts Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-danger">
                    <tr>
                        <th>Service</th>
                        <th>Contact Number</th>
                        <th>Description</th>
                        <th>Office Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Police</td>
                        <td><a href="tel:911" class="text-danger">911</a></td>
                        <td>For crime and law enforcement emergencies.</td>
                        <td>24/7</td>
                    </tr>
                    <tr>
                        <td>Fire Department</td>
                        <td><a href="tel:5551010" class="text-danger">555-1010</a></td>
                        <td>Report fires and hazardous incidents.</td>
                        <td>24/7</td>
                    </tr>
                    <tr>
                        <td>Ambulance</td>
                        <td><a href="tel:5552020" class="text-danger">555-2020</a></td>
                        <td>For medical emergencies and accidents.</td>
                        <td>24/7</td>
                    </tr>
                    <tr>
                        <td>Disaster Response</td>
                        <td><a href="tel:5553030" class="text-danger">555-3030</a></td>
                        <td>For flood, earthquake, and disaster response assistance.</td>
                        <td>24/7</td>
                    </tr>
                    <tr>
                        <td>Electric Company</td>
                        <td><a href="tel:5554040" class="text-danger">555-4040</a></td>
                        <td>Report power outages and electrical hazards.</td>
                        <td>8:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Water Company</td>
                        <td><a href="tel:5555050" class="text-danger">555-5050</a></td>
                        <td>Report water leaks or supply issues.</td>
                        <td>8:00 AM - 5:00 PM</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Additional Info -->
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-outline-success">Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>