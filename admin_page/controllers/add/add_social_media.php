<?php

require_once __DIR__ . '/../social_media_controlles.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'youtube' => isset($_POST['youtube']) ? trim($_POST['youtube']) : '',
        'facebook' => isset($_POST['facebook']) ? trim($_POST['facebook']) : '',
        'twitter' => isset($_POST['twitter']) ? trim($_POST['twitter']) : '',
        'email_crti' => isset($_POST['email_crti']) ? trim($_POST['email_crti']) : '',
        'telephone' => isset($_POST['telephone']) ? trim($_POST['telephone']) : '',
        'id_admin' => $id_admin
    ];

    // Validate the data
    $errors = [];

    // Validate YouTube
    if (empty($data['youtube'])) {
        $errors['youtube'] = "Please enter a valid YouTube link.";
    }

    // Validate Facebook
    if (empty($data['facebook'])) {
        $errors['facebook'] = "Veuillez entrer un lien Facebook valide.";
    }

    // Validate Twitter
    if (empty($data['twitter'])) {
        $errors['twitter'] = "Please enter a valid Facebook link.";
    }

    // Validate email_crti
    if (empty($data['email_crti'])) {
        $errors['email_crti'] = "Please enter a valid CRTI email.";
    } elseif (!filter_var($data['email_crti'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_crti'] = "L'email CRTI n'est pas valide.";
    }

    // Validate telephone
    if (empty($data['telephone'])) {
        $errors['telephone'] = "Please enter a valid phone number.";
    }

    if (empty($errors)) {
        if (add_social_media($data, $pdo)) {
            header("Location: /workshop_crti/admin_page/index.php?view=social_media");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
            header("Location: /workshop_crti/admin_page/index.php?view=add_social_media");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /workshop_crti/admin_page/index.php?view=add_social_media");
        exit();
    }
}
?>
