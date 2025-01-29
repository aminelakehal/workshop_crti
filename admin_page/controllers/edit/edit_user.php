<?php
require_once __DIR__ . '/../user_controller.php';

function edit($pdo) {
    $id = filter_input(INPUT_GET, 'id_edit', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        $_SESSION['error'] = "User ID not specified.";
        header('Location: /workshop_crti/admin_page/index.php?view=user');
        exit;
    }

    $user = get_user_by_id($id, $pdo);
    if (!$user) {
        $_SESSION['error'] = "The requested user does not exist.";
        header('Location: /workshop_crti/admin_page/index.php?view=user');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'prenom' => trim(filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING)),
            'nom' => trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING)),
            'email' => trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)),
            'numero_telephone' => trim(filter_input(INPUT_POST, 'numero_telephone', FILTER_SANITIZE_STRING)),
            'mot_de_passe' => trim(filter_input(INPUT_POST, 'mot_de_passe', FILTER_UNSAFE_RAW))
        ];

        $errors = validate_user_data($data);

        if (empty($errors)) {
            $data['prenom'] = ucfirst(strtolower($data['prenom']));
            $data['nom'] = ucfirst(strtolower($data['nom']));

            if (!empty($data['mot_de_passe'])) {
                $data['mot_de_passe'] = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);
            } else {
                unset($data['mot_de_passe']);
            }

            if (update_user($data, $id, $pdo)) {
                $_SESSION['success'] = "User updated successfully.";
                header('Location: /workshop_crti/admin_page/index.php?view=user');
                exit;
            } else {
                $_SESSION['error'] = "Error updating user.";
            }
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
        }
    }

    return $user;
}

function validate_user_data($data) {
    $errors = [];

    if (empty($data['prenom']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['prenom'])) {
        $errors['prenom'] = "Please enter a valid first name.";
    }

    if (empty($data['nom']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nom'])) {
        $errors['nom'] = "Please enter a valid name.";
    }

    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email.";
    }

    if (empty($data['numero_telephone']) || !preg_match("/^[0-9]{9}$/", $data['numero_telephone'])) {
        $errors['numero_telephone'] = "Please enter a valid phone number (10 digits).";
    }


   

    if (!empty($data['mot_de_passe'])) {
        if (strlen($data['mot_de_passe']) < 8) {
            $errors['mot_de_passe'] = "The password must contain at least 8 characters.";
        } elseif (!preg_match('/[A-Z]/', $data['mot_de_passe'][0])) {
            $errors['mot_de_passe'] = "The password must start with an uppercase letter.";
        } elseif (!preg_match('/[0-9]/', $data['mot_de_passe'])) {
            $errors['mot_de_passe'] = "The password must contain at least one digit.";
        }
    }

    return $errors;
}

$user = edit($pdo);
?>