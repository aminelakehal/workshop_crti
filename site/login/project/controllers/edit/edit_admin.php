<?php
require_once __DIR__ . '/../Admin_controllers.php';

function edit($pdo) {
    $id = filter_input(INPUT_GET, 'id_edit_admin', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        $_SESSION['error'] = "ID d'utilisateur non spécifié.";
        header('Location: index.php?view=Admin');
        exit;
    }

    $admin = get_admin_by_id($id, $pdo);
    if (!$admin) {
        $_SESSION['error'] = "L'utilisateur demandé n'existe pas.";
        header('Location: index.php?view=Admin');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'prenom_admin' => filter_input(INPUT_POST, 'prenom_admin', FILTER_SANITIZE_STRING),
            'nom_admin' => filter_input(INPUT_POST, 'nom_admin', FILTER_SANITIZE_STRING),
            'email_admin' => filter_input(INPUT_POST, 'email_admin', FILTER_SANITIZE_EMAIL),
            'Role' => filter_input(INPUT_POST, 'Role', FILTER_SANITIZE_STRING),
        ];

        $errors = [];

        // Validation du prénom
        if (empty($data['prenom_admin']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['prenom_admin'])) {
            $errors['prenom_admin'] = "Veuillez entrer un prénom valide.";
        } else {
            $data['prenom_admin'] = ucfirst(strtolower($data['prenom_admin'])); // Mettre la première lettre en majuscule
        }

        // Validation du nom
        if (empty($data['nom_admin']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nom_admin'])) {
            $errors['nom_admin'] = "Veuillez entrer un nom valide.";
        } else {
            $data['nom_admin'] = ucfirst(strtolower($data['nom_admin'])); // Mettre la première lettre en majuscule
        }

        // Validation de l'email
        if (empty($data['email_admin']) || !filter_var($data['email_admin'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_admin'] = "Veuillez entrer un email valide.";
        }

        // Validation du rôle
        $allowed_roles = ['admin', 'suivie']; // Liste des rôles autorisés
        if (empty($data['Role']) || !in_array($data['Role'], $allowed_roles)) {
            $errors['Role'] = "Veuillez sélectionner un rôle valide.";
        }

        if (empty($errors)) {
            // Mettre à jour l'utilisateur avec les données validées
            $data['prenom_admin'] = ucfirst(strtolower($data['prenom_admin']));
            $data['nom_admin'] = ucfirst(strtolower($data['nom_admin']));

            if (update_admin($data, $id, $pdo)) {
                $_SESSION['success'] = "Administrateur mis à jour avec succès.";
                header('Location: index.php?view=Admin');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de l'administrateur.";
            }
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
        }
    }

    return $admin;
}

$admin = edit($pdo);
?>
