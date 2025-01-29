<?php
require_once __DIR__ . '/../../controllers/edit/edit_admin.php';
require_once __DIR__ . '/../../layout/header.php';
?>

<div class="container mt-5">
<div class="titre mb-4">
    <h2>Éditer un Admin</h2>

    <form action="" method="POST">
        <div class="form-group">
            <label for="prenom_admin">Prénom</label>
            <input type="text" class="form-control" id="prenom_admin" name="prenom_admin" value="<?php echo isset($_SESSION['data']['prenom_admin']) ? htmlspecialchars($_SESSION['data']['prenom_admin']) : htmlspecialchars($admin ['prenom_admin']); ?>" required>
        </div>

        <div class="form-group">
            <label for="nom_admin">Nom</label>
            <input type="text" class="form-control" id="nom_admin" name="nom_admin" value="<?php echo isset($_SESSION['data']['nom_admin']) ? htmlspecialchars($_SESSION['data']['nom_admin']) : htmlspecialchars($admin ['nom_admin']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email_admin">Email</label>
            <input type="email" class="form-control" id="email_admin" name="email_admin" value="<?php echo isset($_SESSION['data']['email_admin']) ? htmlspecialchars($_SESSION['data']['email_admin']) : htmlspecialchars($admin ['email_admin']); ?>" required>
        </div>

        <div class="form-group">
            <label for="mot_passe_admin">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="mot_passe_admin" name="mot_passe_admin">
        </div>

        <div class="form-group">
            <label for="confirm_mot_passe_admin">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_mot_passe_admin" name="confirm_mot_passe_admin">
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
