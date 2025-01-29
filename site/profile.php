<?php
require_once __DIR__ . '/controllers/user_controller.php';
require_once __DIR__ . '/controllers/social_media_controller.php'; 
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $user = get_user_by_id($id_user, $pdo);
    if (!$user) {
        $_SESSION['error'] = 'Utilisateur non trouvé.';
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

function validateInputs($prenom, $nom, $numero_telephone, $mot_de_passe) {
    $errors = [];
    if (empty($prenom)) {
        $errors['prenom'] = 'Prénom est requis.';
    }
    if (empty($nom)) {
        $errors['nom'] = 'Nom est requis.';
    }
    if (empty($numero_telephone)) {
        $errors['numero_telephone'] = 'Numéro de téléphone est requis.';
    } elseif (!preg_match('/^[0-9]{9}$/', $numero_telephone)) {
        $errors['numero_telephone'] = 'Numéro de téléphone invalide.';
    }
    if (!empty($mot_de_passe) && (!preg_match('/[A-Z]/', $mot_de_passe) || strlen($mot_de_passe) < 8)) {
        $errors['mot_de_passe'] = 'Le mot de passe doit contenir au moins une lettre majuscule et 8 caractères.';
    }
    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $numero_telephone = filter_input(INPUT_POST, 'numero_telephone', FILTER_SANITIZE_STRING);
    $mot_de_passe = filter_input(INPUT_POST, 'mot_de_passe', FILTER_DEFAULT);

    // Remove leading zero from phone number
    $numero_telephone = ltrim($numero_telephone, '0');

    $errors = validateInputs($prenom, $nom, $numero_telephone, $mot_de_passe);

    if (empty($errors)) {
        $data = [
            'prenom' => $prenom,
            'nom' => $nom,
            'numero_telephone' => $numero_telephone,
        ];
        if (!empty($mot_de_passe)) {
            $data['mot_de_passe'] = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        }

        $result = update_user($data, $id_user, $pdo);
        if ($result) {
            $_SESSION['success'] = 'Profil mis à jour avec succès.';
            $_SESSION['prenom'] = $prenom;
            $_SESSION['nom'] = $nom;
        } else {
            $_SESSION['error'] = 'Erreur lors de la mise à jour du profil.';
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = $_POST;
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<?php
require_once __DIR__ . '/layout/sidbar_registration.php';
?>

<style>
    .mt-5, .my-5 {
  margin-top: 9rem !important;
}

</style>



<div class="profile-update-form mt-5">
    <h3>User Profile</h3>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="prenom">First Name</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($_SESSION['data']['prenom'] ?? $user['prenom']); ?>" required>
            <?php if (isset($_SESSION['errors']['prenom'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['errors']['prenom']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="nom">Last Name</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($_SESSION['data']['nom'] ?? $user['nom']); ?>" required>
            <?php if (isset($_SESSION['errors']['nom'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['errors']['nom']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="numero_telephone">Phone Number</label>
            <input type="tel" class="form-control" id="numero_telephone" name="numero_telephone" value="<?= htmlspecialchars($_SESSION['data']['numero_telephone'] ?? $user['numero_telephone']); ?>" required>
            <?php if (isset($_SESSION['errors']['numero_telephone'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['errors']['numero_telephone']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Password (leave empty to keep unchanged)</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
            <?php if (isset($_SESSION['errors']['mot_de_passe'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['errors']['mot_de_passe']); ?></div>
            <?php endif; ?>
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
        <a href="index.php?view=nom" class="btn btn-secondary">Cancel</a>
    </form>
</div>


<?php
require_once __DIR__ . '/layout/footer.php';
?>

<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
?>
