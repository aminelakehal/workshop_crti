<?php
session_start(); 

require_once __DIR__ . '/../Admin_controllers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'prenom_admin' => isset($_POST['prenom_admin']) ? trim($_POST['prenom_admin']) : '',
        'nom_admin' => isset($_POST['nom_admin']) ? trim($_POST['nom_admin']) : '',
        'email_admin' => isset($_POST['email_admin']) ? trim($_POST['email_admin']) : '',
        'Role' => isset($_POST['Role']) ? trim($_POST['Role']) : '',
        'mot_passe_admin' => isset($_POST['mot_passe_admin']) ? $_POST['mot_passe_admin'] : '',
    ];
    
    $errors = [];

    if (empty($data['prenom_admin']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['prenom_admin'])) {
        $errors['prenom_admin'] = "Veuillez entrer un prénom valide.";
    } else {
        $data['prenom_admin'] = ucfirst(strtolower($data['prenom_admin'])); 
    }

    if (empty($data['nom_admin']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nom_admin'])) {
        $errors['nom_admin'] = "Veuillez entrer un nom valide.";
    } else {
        $data['nom_admin'] = ucfirst(strtolower($data['nom_admin'])); 
    }

    if (empty($data['email_admin']) || !filter_var($data['email_admin'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_admin'] = "Veuillez entrer un email valide.";
    } elseif (email_exists($data['email_admin'], $pdo)) {
        $errors['email_admin'] = "Cet email est déjà utilisé.";
    }

    if (empty($data['mot_passe_admin'])) {
        $errors['mot_passe_admin'] = "Veuillez entrer un mot de passe.";
    } elseif (strlen($data['mot_passe_admin']) < 8) {
        $errors['mot_passe_admin'] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    $allowed_roles = ['admin', 'suivie']; 
    if (empty($data['Role']) || !in_array($data['Role'], $allowed_roles)) {
        $errors['Role'] = "Veuillez sélectionner un rôle valide.";
    }

    if (empty($errors)) {
        $data['mot_passe_admin'] = password_hash($data['mot_passe_admin'], PASSWORD_BCRYPT);

        if (add_admin($data, $pdo)) {
            header("Location: /project/index.php?view=Admin"); 
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
            header("Location: /project/index.php?view=add_admin");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /project/index.php?view=add_admin");
        exit();
    }
}

function email_exists($email, $pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS num_rows FROM admin WHERE email_admin = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['num_rows'] > 0;
}
?>
