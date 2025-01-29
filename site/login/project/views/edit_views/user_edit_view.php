<?php
require_once __DIR__ . '/../../controllers/edit/edit_user.php';
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
    <h2>Éditer un utilisateur</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($_SESSION['data']['prenom']) ? htmlspecialchars($_SESSION['data']['prenom']) : htmlspecialchars($user['prenom']); ?>" required>
            <?php if (isset($_SESSION['errors']['prenom'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['prenom']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($_SESSION['data']['nom']) ? htmlspecialchars($_SESSION['data']['nom']) : htmlspecialchars($user['nom']); ?>" required>
            <?php if (isset($_SESSION['errors']['nom'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['nom']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_SESSION['data']['email']) ? htmlspecialchars($_SESSION['data']['email']) : htmlspecialchars($user['email']); ?>" required>
            <?php if (isset($_SESSION['errors']['email'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['email']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="numero_telephone">Numéro de téléphone</label>
            <input type="tel" class="form-control" id="numero_telephone" name="numero_telephone" value="<?php echo isset($_SESSION['data']['numero_telephone']) ? htmlspecialchars($_SESSION['data']['numero_telephone']) : htmlspecialchars($user['numero_telephone']); ?>" required>
            <?php if (isset($_SESSION['errors']['numero_telephone'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['numero_telephone']); ?></div>
            <?php endif; ?>
        </div>
        <input type="submit" value="Mettre à jour" class="btn btn-primary">
        <a href="index.php?view=user" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';