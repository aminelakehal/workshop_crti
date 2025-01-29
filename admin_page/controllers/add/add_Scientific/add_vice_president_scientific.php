<?php
require_once __DIR__ . '/../../scientifique_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'V_president_S' => isset($_POST['V_president_S']) ? trim($_POST['V_president_S']) : '',
        'id_admin' => $id_admin
    ];

    // Validate the data
    $errors = [];
    
    // Validate V_president_S
    if (empty($data['V_president_S']) || !is_string($data['V_president_S'])) {
        $errors['V_president_S'] = "Please enter a valid Vice president.";
    } else {
        $data['V_president_S'] = ucfirst(strtolower($data['V_president_S']));
    }

    if (empty($errors)) {
        if (add_vice_president_scientific($data, $pdo)) {
            header("Location: /workshop_crti/admin_page/index.php?view=add_scientific");
            $_SESSION['success'] = "Vice president added successfully!";
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Error adding Vice president.";
            header("Location: /workshop_crti/admin_page/index.php?view=add_scientific");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /workshop_crti/admin_page/index.php?view=add_scientific");
        exit();
    }
}
?>
