<?php
// events_listing.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Community Events Listing">
    <meta name="author" content="Your Name">
    <title>Events Listing</title>
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
        <h1 class="text-center text-primary mb-4">Upcoming Community Events</h1>
        <p class="text-center text-muted mb-5">Stay updated on the latest events happening in our community.</p>

        <!-- Events List -->
        <div class="list-group">
            <!-- Event 1 -->
            <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                <h5 class="mb-2 text-dark">Tree Planting Activity</h5>
                <p class="mb-2 text-muted"><i class="bi bi-calendar-date"></i> Date: December 20, 2024</p>
                <p class="mb-2 text-muted"><i class="bi bi-clock"></i> Time: 8:00 AM - 12:00 PM</p>
                <p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: Municipal Park</p>
                <p class="mb-3">Join us in making the environment greener by planting trees in our community.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">RSVP Now</a>
            </div>
            <!-- Event 2 -->
            <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                <h5 class="mb-2 text-dark">Health and Wellness Fair</h5>
                <p class="mb-2 text-muted"><i class="bi bi-calendar-date"></i> Date: January 10, 2025</p>
                <p class="mb-2 text-muted"><i class="bi bi-clock"></i> Time: 9:00 AM - 3:00 PM</p>
                <p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: Community Hall</p>
                <p class="mb-3">Free medical check-ups and wellness workshops for residents.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">RSVP Now</a>
            </div>
            <!-- Event 3 -->
            <div class="list-group-item list-group-item-action mb-3 shadow-sm">
                <h5 class="mb-2 text-dark">Disaster Preparedness Workshop</h5>
                <p class="mb-2 text-muted"><i class="bi bi-calendar-date"></i> Date: January 15, 2025</p>
                <p class="mb-2 text-muted"><i class="bi bi-clock"></i> Time: 1:00 PM - 5:00 PM</p>
                <p class="mb-2 text-muted"><i class="bi bi-geo-alt"></i> Location: Municipal Gymnasium</p>
                <p class="mb-3">Learn how to prepare and respond to disasters effectively.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">RSVP Now</a>
            </div>
        </div>

        <!-- Suggest Event Form -->
        <div class="mt-5">
            <h5 class="text-center text-success mb-4">Suggest an Event</h5>
            <form>
                <div class="mb-3">
                    <label for="eventTitle" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="eventTitle" placeholder="Enter event title" required>
                </div>
                <div class="mb-3">
                    <label for="eventDate" class="form-label">Event Date</label>
                    <input type="date" class="form-control" id="eventDate" required>
                </div>
                <div class="mb-3">
                    <label for="eventTime" class="form-label">Event Time</label>
                    <input type="time" class="form-control" id="eventTime" required>
                </div>
                <div class="mb-3">
                    <label for="eventLocation" class="form-label">Event Location</label>
                    <input type="text" class="form-control" id="eventLocation" placeholder="Enter event location" required>
                </div>
                <div class="mb-3">
                    <label for="eventDescription" class="form-label">Event Description</label>
                    <textarea class="form-control" id="eventDescription" rows="3" placeholder="Enter event description" required></textarea>
                </div>
                <button type="submit" class="btn btn-outline-success">Submit Event</button>
            </form>
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