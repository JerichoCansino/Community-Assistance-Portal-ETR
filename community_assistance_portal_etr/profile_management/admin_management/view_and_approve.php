<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Community Events</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Manage Community Event Suggestions</h2>

            <!-- Event Suggestions Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Event Title</th>
                            <th>Date</th>
                            <th>Submitted By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Row -->
                        <tr>
                            <td>1</td>
                            <td>Community Cleanup</td>
                            <td>2025-01-10</td>
                            <td>John Doe</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#eventDetailsModal" data-event='{"title": "Community Cleanup", "date": "2025-01-10", "time": "10:00 AM", "location": "Main Park", "description": "A day to clean and beautify the neighborhood."}'>
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <button class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </td>
                        </tr>
                        <!-- Additional rows go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Event Title</label>
                            <input type="text" class="form-control" id="eventTitle" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="eventDate" class="form-label">Event Date</label>
                                <input type="text" class="form-control" id="eventDate" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="eventTime" class="form-label">Event Time</label>
                                <input type="text" class="form-control" id="eventTime" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="eventLocation" class="form-label">Event Location</label>
                            <input type="text" class="form-control" id="eventLocation" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Event Description</label>
                            <textarea class="form-control" id="eventDescription" rows="4" readonly></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2025 Sta. Barbara Community Assistance Portal. All rights reserved.</p>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script to Populate Modal with Event Details -->
    <script>
        const eventDetailsModal = document.getElementById('eventDetailsModal');

        eventDetailsModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const eventData = JSON.parse(button.getAttribute('data-event'));

            document.getElementById('eventTitle').value = eventData.title;
            document.getElementById('eventDate').value = eventData.date;
            document.getElementById('eventTime').value = eventData.time;
            document.getElementById('eventLocation').value = eventData.location;
            document.getElementById('eventDescription').value = eventData.description;
        });
    </script>
</body>

</html>
