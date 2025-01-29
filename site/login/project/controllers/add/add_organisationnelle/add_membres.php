<?php
session_start();
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
        $errors['membres_O'] = "Veuillez entrer un membres_O valide.";
    } else {
        $data['membres_O'] = ucfirst(strtolower($data['membres_O'])); // Capitalize first letter
    }

    if (empty($errors)) {
        if (add_membres_organisationnelle($data, $pdo)) {
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
