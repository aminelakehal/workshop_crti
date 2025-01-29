<?php
require_once __DIR__ . '/../../organisationnelle_controllers.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'vice_president_O' => isset($_POST['vice_president_O']) ? trim($_POST['vice_president_O']) : '',
        'id_admin' => $id_admin,
        
    ];

    $errors = [];
    if (!empty($data['vice_president_O']) && !preg_match("/^[a-zA-Z-' ]*$/", $data['vice_president_O'])) {
        $errors['vice_president_O'] = "Please enter a valid vice president.";
    } else {
        $data['vice_president_O'] = ucfirst(strtolower($data['vice_president_O']));
    }
    if (empty($errors)) {
        if (add_vice_president_organisationnelle($data, $pdo)) {
            $_SESSION['success'] = "vice president added successfully!";
            header("Location: /workshop_crti/admin_page/index.php?view=add_organisationnelle");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Error adding vice president.";
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
