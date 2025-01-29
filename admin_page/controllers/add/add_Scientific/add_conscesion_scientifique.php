<?php

require_once __DIR__ . '/../../scientifique_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);

    if (isset($_POST['president_S'])) {
        $data = [
            'president_S' => isset($_POST['president_S']) ? trim($_POST['president_S']) : '',
            'id_admin' => $id_admin
        ];

        // Validation des données
        $errors = [];
        if (empty($data['president_S']) || !is_string($data['president_S'])) {
            $errors['president_S'] = "Please enter a valid president.";
        } else {
            $data['president_S'] = ucfirst(strtolower($data['president_S']));
        }
        

        if (empty($errors)) {
            if (add_concession_scientific($data, $pdo)) {
                header("Location: /workshop_crti/admin_page/index.php?view=add_scientific");
                $_SESSION['success'] = "president added successfully!";
                exit();
            } else {
                $_SESSION['data'] = $data;
                $_SESSION['error'] = "Error adding.";
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
}
?>