<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 3rem;
        }

        footer {
            background: #222;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="60" height="60" class="me-2">
                <span class="fw-bold">Sta. Barbara Community Assistance Portal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">No new notifications</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Dashboard Section -->
        <section class="py-5 bg-light">
            <div class="container text-center">
                <h2 class="mb-4 fw-bold">Dashboard</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <!-- Total Users -->
                    <div class="col">
                        <a href="manage_users.php" class="text-decoration-none">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <i class="bi bi-people-fill text-primary"></i>
                                    <h3 class="mt-3 text-primary fw-bold">1,234</h3>
                                    <p class="m-0 text-muted">Total Users</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Total Services Offered -->
                    <div class="col">
                        <a href="manage_services.php" class="text-decoration-none">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <i class="bi bi-briefcase text-warning"></i>
                                    <h3 class="mt-3 text-warning fw-bold">15</h3>
                                    <p class="m-0 text-muted">Services Offered</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-white text-center py-4">
        <p class="mb-1">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
        <p>Contact us: <a href="mailto:info@sbcommunityportal.com" class="text-light">info@sbcommunityportal.com</a></p>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>