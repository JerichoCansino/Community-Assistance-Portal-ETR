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
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/sblogo.jpg" alt="Logo" width="80" height="80">
                Sta. Barbara Community Assistance Portal
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
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i> Notifications
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">No new notifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-3" href="#"><i class="bi bi-chat-dots"></i> Messaging</a>
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
                <h2 class="mb-4">Dashboard</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Total Users -->
                    <div class="col">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body">
                                <i class="bi bi-people-fill fs-1 text-primary"></i>
                                <h3 class="mt-3 text-primary fw-bold">1,234</h3>
                                <p class="m-0">Total Users</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Staff -->
                    <div class="col">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body">
                                <i class="bi bi-person-badge fs-1 text-success"></i>
                                <h3 class="mt-3 text-success fw-bold">56</h3>
                                <p class="m-0">Total Staff</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Services Offered -->
                    <div class="col">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body">
                                <i class="bi bi-briefcase fs-1 text-warning"></i>
                                <h3 class="mt-3 text-warning fw-bold">15</h3>
                                <p class="m-0">Services Offered</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-2">&copy; 2024 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
        <p>Contact us: <a href="mailto:info@sbcommunityportal.com" class="text-light">info@sbcommunityportal.com</a></p>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
