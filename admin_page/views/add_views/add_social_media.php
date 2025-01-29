<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
    <h2>Add a social network</h2>
    <form action="controllers/add/add_social_media.php" method="POST">
        <div class="form-group">
            <label for="youtube">YouTube</label>
            <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo isset($_SESSION['data']['youtube']) ? htmlspecialchars($_SESSION['data']['youtube']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['youtube'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['youtube']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo isset($_SESSION['data']['facebook']) ? htmlspecialchars($_SESSION['data']['facebook']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['facebook'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['facebook']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo isset($_SESSION['data']['twitter']) ? htmlspecialchars($_SESSION['data']['twitter']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['twitter'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['twitter']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email_crti">Email CRTI</label>
            <input type="email" class="form-control" id="email_crti" name="email_crti" value="<?php echo isset($_SESSION['data']['email_crti']) ? htmlspecialchars($_SESSION['data']['email_crti']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['email_crti'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['email_crti']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo isset($_SESSION['data']['telephone']) ? htmlspecialchars($_SESSION['data']['telephone']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['telephone'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['telephone']); ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php?view=social_media" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';
?>
