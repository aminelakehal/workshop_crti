<?php
require_once __DIR__ . '/../../organisationnelle_controllers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'membres_O' => isset($_POST['membres_O']) ? trim($_POST['membres_O']) : '',
      
        'id_admin' => $id_admin
    ];

    // Validate the data
    $errors = [];

    // Validate membres_O
    if (!empty($data['membres_O']) && !preg_match("/^[a-zA-Z-' ]*$/", $data['membres_O'])) {
        $errors['membres_O'] = "Please enter a valid membres.";
    } else {
        $data['membres_O'] = ucfirst(strtolower($data['membres_O'])); // Capitalize first letter
    }

    if (empty($errors)) {
        if (add_membres_organisationnelle($data, $pdo)) {
            $_SESSION['success'] = "membres added successfully!";
            header("Location: /workshop_crti/admin_page/index.php?view=add_organisationnelle");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Error adding members.";
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
