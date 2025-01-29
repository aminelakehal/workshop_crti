<?php
require_once __DIR__ . '/../../controllers/edit/edit_admin.php';
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
    <h2>Éditer un Admin</h2>


    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); ?></div>


    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="prenom_admin">Prénom</label>
            <input type="text" class="form-control" id="prenom_admin" name="prenom_admin" value="<?php echo isset($_SESSION['data']['prenom_admin']) ? htmlspecialchars($_SESSION['data']['prenom_admin']) : htmlspecialchars($admin ['prenom_admin']); ?>" required>
            <?php if (isset($_SESSION['errors']['prenom_admin'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['prenom_admin']); ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nom_admin">Prénom</label>
            <input type="text" class="form-control" id="nom_admin" name="nom_admin" value="<?php echo isset($_SESSION['data']['nom_admin']) ? htmlspecialchars($_SESSION['data']['nom_admin']) : htmlspecialchars($admin ['nom_admin']); ?>" required>
            <?php if (isset($_SESSION['errors']['nom_admin'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['nom_admin']); ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email_admin">Email</label>
            <input type="email" class="form-control" id="email_admin" name="email_admin" value="<?php echo isset($_SESSION['data']['email_admin']) ? htmlspecialchars($_SESSION['data']['email_admin']) : htmlspecialchars($admin ['email_admin']); ?>" required>
            <?php if (isset($_SESSION['errors']['email_admin'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['email_admin']); ?></div>
            <?php endif; ?>
        </div>

      
        <div class="form-group">
            <label for="Role">Rôle</label>
            <select class="form-control" id="Role" name="Role" required>
                <option value="" selected disabled>Choisir un rôle</option>
                <option value="admin" <?php echo (isset($_SESSION['data']['Role']) && $_SESSION['data']['Role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="suivie" <?php echo (isset($_SESSION['data']['Role']) && $_SESSION['data']['Role'] === 'suivie') ? 'selected' : ''; ?>>Suvire</option>
            </select>
            <?php if (isset($_SESSION['errors']['Role'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['Role']); ?></div>
            <?php endif; ?>
        </div>

        <input type="submit" value="Mettre à jour" class="btn btn-primary">
        <a href="index.php?view=Admin" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';
?>
