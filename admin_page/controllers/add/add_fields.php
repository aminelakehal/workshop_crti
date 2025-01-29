<?php

require_once __DIR__ . '/../controller_fields.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = [
        'field_name' => isset($_POST['field_name']) ? trim($_POST['field_name']) : '',
        
    ];

    // Validate the data
    $errors = [];

    // Validate field_name
    if (empty($data['field_name'])) {
        $errors['field_name'] = "Please enter a valid field name.";
    } else {
        $data['field_name'] = ucfirst(strtolower($data['field_name']));
    }

    if (empty($errors)) {
        if (add_file_fields($data, $pdo)) {
            header("Location: /workshop_crti/admin_page/index.php?view=fields");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Erreur lors de l'ajout du champ.";
            header("Location: /workshop_crti/admin_page/index.php?view=fields");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /workshop_crti/admin_page/index.php?view=add_fields");
        exit();
    }
}


?>
