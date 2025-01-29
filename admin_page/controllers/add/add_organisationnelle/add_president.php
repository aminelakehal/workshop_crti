<?php
require_once __DIR__ . '/../../organisationnelle_controllers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'president_O' => isset($_POST['president_O']) ? trim($_POST['president_O']) : '',
        'id_admin' => $id_admin
    ];

    // Validate the data
    $errors = [];
    // Validate president_O
    if (!empty($data['president_O']) && !preg_match("/^[a-zA-Z-' ]*$/", $data['president_O'])) {
        $errors['president_O'] = "Please enter a valid president.";
    } else {
        $data['president_O'] = ucfirst(strtolower($data['president_O']));
    }
    if (empty($errors)) {
        if (add_president_organisationnelle($data, $pdo)) {
            $_SESSION['success'] = "president added successfully!";
            header("Location: /workshop_crti/admin_page/index.php?view=add_organisationnelle");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
            header("Location: /workshop_crti/admin_page/index.php?view=add_organisationnelle");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /workshop_crti/admin_page/index.php?view=add_organisationnelle");
        exit();
    }
}
?>
