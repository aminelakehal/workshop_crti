<?php
require_once __DIR__ . '/../../layout/header.php';
?>

<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Add a new theme</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
            <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form action="controllers/add/add_theme.php" method="post">
            <label for="title_home">Title Home Workshop:</label>
            <input type="text" id="title_home" name="title_home" value="<?= htmlspecialchars($input['title_home'] ?? '') ?>" required>
            <span style="color:red;"><?= $errors['title_home'] ?? '' ?></span>

            <label for="presedant_workshop">Presedant Workshop:</label>
            <input type="text" id="presedant_workshop" name="presedant_workshop" value="<?= htmlspecialchars($input['presedant_workshop'] ?? '') ?>" required>
            <span style="color:red;"><?= $errors['presedant_workshop'] ?? '' ?></span>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($input['description'] ?? '') ?></textarea>
            <span style="color:red;"><?= $errors['description'] ?? '' ?></span>

            <label for="paper_submission_date">Paper Submission Date:</label>
            <input type="date" id="paper_submission_date" name="paper_submission_date" value="<?= htmlspecialchars($input['paper_submission_date'] ?? '') ?>" required>
            <span style="color:red;"><?= $errors['paper_submission_date'] ?? '' ?></span>

            <label for="acceptance_notification_date">Acceptance Notification Date:</label>
            <input type="date" id="acceptance_notification_date" name="acceptance_notification_date" value="<?= htmlspecialchars($input['acceptance_notification_date'] ?? '') ?>" required>
            <span style="color:red;"><?= $errors['acceptance_notification_date'] ?? '' ?></span>

            <label for="workshop_dates">Workshop Dates:</label>
            <input type="text" id="workshop_dates" name="workshop_dates" value="<?= htmlspecialchars($input['workshop_dates'] ?? '') ?>" required>
            <span style="color:red;"><?= $errors['workshop_dates'] ?? '' ?></span>

            <label for="registration_fee">Registration Fee (DA):</label>
            <input type="number" id="registration_fee" name="registration_fee" step="0.01" value="<?= htmlspecialchars($input['registration_fee'] ?? '') ?>">
            <span style="color:red;"><?= $errors['registration_fee'] ?? '' ?></span>

            <label for="additional_info">Additional Info (separate by '|'):</label>
            <textarea id="additional_info" name="additional_info" rows="4" required><?= htmlspecialchars($input['additional_info'] ?? '') ?></textarea>
            <span style="color:red;"><?= $errors['additional_info'] ?? '' ?></span>

            <input type="submit" value="Add">
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/../../layout/footer.php';


unset($_SESSION['errors']);
unset($_SESSION['input']);
unset($_SESSION['success']);

?>

<script>
    const timeout = 3000;

    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, timeout);
    }

    const errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, timeout);
    }
</script>