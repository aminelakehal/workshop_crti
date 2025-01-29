<?php


require_once __DIR__ . '/../user_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = isset($_SESSION['id_admin']) ? intval($_SESSION['id_admin']) : null;
    $data = [
        'prenom' => isset($_POST['prenom']) ? trim($_POST['prenom']) : '',
        'nom' => isset($_POST['nom']) ? trim($_POST['nom']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'numero_telephone' => isset($_POST['numero_telephone']) ? trim($_POST['numero_telephone']) : '',
        'id_admin' => $id_admin 
    ];

    // Validate the data
    $errors = [];

    // Validate first name
    if (empty($data['prenom']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['prenom'])) {
        $errors['prenom'] = "Please enter a valid first name.";
    } else {
        $data['prenom'] = ucfirst(strtolower($data['prenom'])); // Capitalize first letter
    }

    // Validate last name
    if (empty($data['nom']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nom'])) {
        $errors['nom'] = "Please enter a valid name.";
    } else {
        $data['nom'] = ucfirst(strtolower($data['nom'])); // Capitalize first letter
    }

    // Validate email
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email.";
    }

    // Validate phone number
    if (empty($data['numero_telephone']) || !preg_match("/^[0-9]{10}$/", $data['numero_telephone'])) {
        $errors['numero_telephone'] = "Please enter a valid phone number.";
    }

    if (empty($errors)) {
        if (add_user($data, $pdo)) {
            header("Location:  /worckshop_crti/admin_page/index.php?view=user");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Error adding user.";
            header("Location:  /worckshop_crti/admin_page/index.php?view=add_user");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location:  /worckshop_crti/admin_page/index.php?view=add_user");
        exit();
    }
}
?>
