<?php
require_once __DIR__ . '/../../scientifique_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'membres_S' => isset($_POST['membres_S']) ? trim($_POST['membres_S']) : '',
        'id_admin' => $id_admin
    ];

    
    // Validate membres_S
    $errors = [];
    if (empty($data['membres_S']) || !is_string($data['membres_S'])) {
        $errors['membres_S'] = "Please enter a valid membres.";
    } else {
        $data['membres_S'] = ucfirst(strtolower($data['membres_S']));
    }

    if (empty($errors)) {
        if (add_membres_scientific($data, $pdo)) {
            header("Location: /workshop_crti/admin_page/index.php?view=add_scientific");
            $_SESSION['success'] = "membres added successfully!";
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
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
