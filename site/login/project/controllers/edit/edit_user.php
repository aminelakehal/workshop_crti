<?php
require_once __DIR__ . '/../user_controller.php';

function edit($pdo) {
    $id = filter_input(INPUT_GET, 'id_edit', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        $_SESSION['error'] = "ID d'utilisateur non spécifié.";
        header('Location: index.php?view=user');
        exit;
    }

    $user = get_user_by_id($id, $pdo);
    if (!$user) {
        $_SESSION['error'] = "L'utilisateur demandé n'existe pas.";
        header('Location: index.php?view=user');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'prenom' => filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING),
            'nom' => filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'numero_telephone' => filter_input(INPUT_POST, 'numero_telephone', FILTER_SANITIZE_STRING),
        ];

        $errors = [];

        if (empty($data['prenom']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['prenom'])) {
            $errors['prenom'] = "Veuillez entrer un prénom valide.";
        }

        if (empty($data['nom']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nom'])) {
            $errors['nom'] = "Veuillez entrer un nom valide.";
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Veuillez entrer un email valide.";
        }

        if (empty($data['numero_telephone']) || !preg_match("/^[0-9]{10}$/", $data['numero_telephone'])) {
            $errors['numero_telephone'] = "Veuillez entrer un numéro de téléphone valide.";
        }

        if (empty($errors)) {
            // Capitaliser la première lettre du prénom et du nom
            $data['prenom'] = ucfirst(strtolower($data['prenom']));
            $data['nom'] = ucfirst(strtolower($data['nom']));

            if (update_user($data, $id, $pdo)) {
                $_SESSION['success'] = "Utilisateur mis à jour avec succès.";
                header('Location: index.php?view=user');
                exit;
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de l'utilisateur.";
            }
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
        }
    }

    return $user;
}

$user = edit($pdo);
?>