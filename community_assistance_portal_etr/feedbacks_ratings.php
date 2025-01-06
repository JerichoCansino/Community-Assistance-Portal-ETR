<?php
include('database/db_connection.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: profile_management/login.php");
    exit;
}

$query = "SELECT f.id AS feedback_id, f.name, f.rating, f.feedback, f.submitted_on,
                 r.reply, r.submitted_on AS replied_on, r.role
          FROM feedbacks f
          LEFT JOIN feedback_replies r ON f.id = r.feedback_id
          ORDER BY f.submitted_on DESC, r.submitted_on ASC";
$result = mysqli_query($conn, $query);

$feedbacks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $feedback_id = $row['feedback_id'];
    if (!isset($feedbacks[$feedback_id])) {
        $feedbacks[$feedback_id] = [
            'name' => $row['name'],
            'rating' => $row['rating'],
            'feedback' => $row['feedback'],
            'submitted_on' => $row['submitted_on'],
            'replies' => []
        ];
    }
    if ($row['reply']) {
        $feedbacks[$feedback_id]['replies'][] = [
            'reply' => $row['reply'],
            'replied_on' => $row['replied_on'],
            'role' => $row['role']
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Feedbacks and Replies">
    <meta name="author" content="Your Name">
    <title>Feedbacks and Replies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Feedback System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="text-primary text-center mb-4">Feedbacks and Ratings</h1>
        <p class="text-center">Share your thoughts and rate our services.</p>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h5 class="card-title text-center text-primary">Submit Your Feedback</h5>
                <form id="feedbackForm">
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
                            <i class="bi bi-star text-muted" data-value="1"></i>
                            <i class="bi bi-star text-muted" data-value="2"></i>
                            <i class="bi bi-star text-muted" data-value="3"></i>
                            <i class="bi bi-star text-muted" data-value="4"></i>
                            <i class="bi bi-star text-muted" data-value="5"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" rows="4" placeholder="Write your feedback"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const stars = document.querySelectorAll("#rating .bi-star");
            let selectedRating = 0;

            stars.forEach((star) => {
                star.addEventListener("click", function () {
                    selectedRating = parseInt(this.dataset.value);
                    updateStars(selectedRating);
                });
            });

            function updateStars(rating) {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add("text-warning");
                        star.classList.remove("text-muted");
                    } else {
                        star.classList.add("text-muted");
                        star.classList.remove("text-warning");
                    }
                });
            }

            document.querySelector("#feedbackForm").addEventListener("submit", function (e) {
                e.preventDefault();

                const formData = new FormData();
                formData.append("name", document.querySelector("#name").value.trim());
                formData.append("email", document.querySelector("#email").value.trim());
                formData.append("rating", selectedRating);
                formData.append("feedback", document.querySelector("#feedback").value.trim());

                fetch("submit_feedback.php", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        alert(data.message);
                        if (data.status === "success") {
                            loadFeedbacks();
                            document.querySelector("#feedbackForm").reset();
                            updateStars(0); // Reset stars
                            selectedRating = 0; // Reset rating
                        }
                    })
                    .catch((error) => {
                        console.error("Error submitting feedback:", error);
                    });
            });

            
        });
    </script>
    <div class="container my-5">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Feedback and Replies</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feedbacks as $feedback_id => $feedback): ?>
                            <tr>
                                <td><?= htmlspecialchars($feedback['name'] ?: 'Anonymous') ?></td>
                                <td><?= str_repeat('⭐', $feedback['rating']) ?></td>
                                <td>
                                    <p><?= htmlspecialchars($feedback['feedback']) ?></p>
                                    <?php if (!empty($feedback['replies'])): ?>
                                        <div class="mt-3">
                                            <strong>Replies:</strong>
                                            <ul class="list-unstyled">
                                                <?php foreach ($feedback['replies'] as $reply): ?>
                                                    <li class="border-top pt-2">
                                                        <p><?= htmlspecialchars($reply['reply']) ?></p>
                                                        <small class="text-muted">
                                                            Replied by <?= htmlspecialchars(ucfirst($reply['role'])) ?> on 
                                                            <?= date('F j, Y, g:i a', strtotime($reply['replied_on'])) ?>
                                                        </small>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('F j, Y, g:i a', strtotime($feedback['submitted_on'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">&copy; <?= date('Y') ?> Feedback System</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
