<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
    <h2>Add a input file</h2>
    <form action="controllers/add/add_fields.php" method="POST">
        <div class="form-group">
            <label for="field_name">input file</label>
            <input type="text" class="form-control" id="field_name" name="field_name" value="<?php echo isset($_SESSION['data']['field_name']) ? htmlspecialchars($_SESSION['data']['field_name']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['field_name'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['field_name']); ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php?view=field" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';
?>

