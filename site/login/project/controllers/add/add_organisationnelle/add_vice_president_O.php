<?php
session_start();
require_once __DIR__ . '/../../organisationnelle_controllers.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    $data = [
        'vice_president_O' => isset($_POST['vice_president_O']) ? trim($_POST['vice_president_O']) : '',
        'id_admin' => $id_admin,
        
    ];

    // Validate the data
    $errors = [];
// Validate vice_president_O
    if (!empty($data['vice_president_O']) && !preg_match("/^[a-zA-Z-' ]*$/", $data['vice_president_O'])) {
        $errors['vice_president_O'] = "Veuillez entrer un vice_president_O valide.";
    } else {
        $data['vice_president_O'] = ucfirst(strtolower($data['vice_president_O']));
    }
    if (empty($errors)) {
        if (add_vice_president_organisationnelle($data, $pdo)) {
            header("Location: /project/index.php?view=organisationnelle");
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
            header("Location: /project/index.php?view=add_organisationnelle.php");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /project/index.php?view=add_organisationnelle.php");
        exit();
    }
}

?>
