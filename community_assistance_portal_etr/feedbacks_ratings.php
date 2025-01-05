<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Feedbacks and Ratings">
    <meta name="author" content="Your Name">
    <title>Feedbacks and Ratings</title>
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
        <h1 class="text-primary text-center mb-4">Feedbacks and Ratings</h1>
        <p class="text-center">Share your thoughts and rate our services. Your feedback is valuable to us!</p>

        <!-- Feedback Form -->
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h5 class="card-title text-center text-primary">Submit Your Feedback</h5>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name (Optional)</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (Optional)</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <div id="rating">
                            <i class="bi bi-star" data-value="1"></i>
                            <i class="bi bi-star" data-value="2"></i>
                            <i class="bi bi-star" data-value="3"></i>
                            <i class="bi bi-star" data-value="4"></i>
                            <i class="bi bi-star" data-value="5"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" rows="4" placeholder="Write your feedback here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
                </form>
            </div>
        </div>

        <!-- Feedback Display -->
        <div>
            <h5 class="text-primary mb-3">Recent Feedback</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Feedback</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane Doe</td>
                            <td>⭐⭐⭐⭐⭐</td>
                            <td>Excellent service! Highly recommended.</td>
                            <td>2024-12-16</td>
                        </tr>
                        <tr>
                            <td>John Smith</td>
                            <td>⭐⭐⭐⭐</td>
                            <td>Great support but could be faster.</td>
                            <td>2024-12-15</td>
                        </tr>
                        <tr>
                            <td>Anonymous</td>
                            <td>⭐⭐⭐⭐⭐</td>
                            <td>Very helpful in times of need!</td>
                            <td>2024-12-14</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Back to Home Button -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-success">Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script>
        // Script for interactive rating
        document.querySelectorAll("#rating .bi-star").forEach((star) => {
            star.addEventListener("click", function() {
                document.querySelectorAll("#rating .bi-star").forEach((s) => s.classList.remove("text-warning"));
                const value = this.getAttribute("data-value");
                for (let i = 1; i <= value; i++) {
                    document.querySelector(`#rating .bi-star[data-value="${i}"]`).classList.add("text-warning");
                }
            });
        });
    </script>
</body>

</html>