<?php
include '../../database/db_connection.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// SQL query to fetch events
$sql = "SELECT `id`, `title`, `date`, `time`, `location`, `description`, `status`, `user_id` FROM `events`";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['event_id']) && isset($_POST['status'])) {
        $event_id = $_POST['event_id'];
        $status = $_POST['status'];

        include '../../database/db_connection.php';

        $sql = "UPDATE `events` SET `status` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $status, $event_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update status']);
        }
        $stmt->close();
        $conn->close();
    }
}
$conn->close();
?>

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
    <div class="mb-4" style="margin-left: 120px;">
        <a href="admin_dashboard.php" class="btn btn-outline-success">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>
    </div>

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
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $index => $event): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $event['title'] ?></td>
                            <td><?= $event['date'] ?></td>
                            <td><?= $event['submitted_by'] ?? 'N/A' ?></td>
                            <td id="status-<?= $event['id'] ?>"><?= $event['status'] ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#eventDetailsModal" data-event='<?= json_encode($event) ?>'>
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <button class="btn btn-success btn-sm btn-approve" data-event-id="<?= $event['id'] ?>">
                                    <i class="bi bi-check-circle"></i> Approve
                                </button>
                                <button class="btn btn-danger btn-sm btn-reject" data-event-id="<?= $event['id'] ?>">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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

        // Event handler for approve/reject buttons
        document.addEventListener('DOMContentLoaded', () => {
            const approveButtons = document.querySelectorAll('.btn-approve');
            const rejectButtons = document.querySelectorAll('.btn-reject');

            // Approve button click handler
            approveButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const eventId = button.dataset.eventId;
                    updateEventStatus(eventId, 'approved');
                    window.location.reload();
                });
            });

            // Reject button click handler
            rejectButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const eventId = button.dataset.eventId;
                    updateEventStatus(eventId, 'rejected');
                    window.location.reload();
                });
            });

            // Function to update event status
            function updateEventStatus(eventId, status) {
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `event_id=${eventId}&status=${status}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        document.querySelector(`#status-${eventId}`).innerText = status;
                        
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error updating event status:', error));
            }
        });
    </script>
</body>

</html>


