<?php

require_once __DIR__ . '/../Admin_controllers.php';
 
$id = filter_input(INPUT_GET, 'id_edit_admin', FILTER_SANITIZE_NUMBER_INT);

if (!$id) {
    $_SESSION['error'] = "ID d'utilisateur non spécifié.";
    header('Location: index.php?view=Admin');
    exit;
}

$admin = get_admin_by_id($id, $pdo);
if (!$admin) {
    $_SESSION['error'] = "L'utilisateur demandé n'existe pas.";
    header('Location: index.php?view=Admin');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'prenom_admin' => filter_input(INPUT_POST, 'prenom_admin', FILTER_SANITIZE_STRING),
        'nom_admin' => filter_input(INPUT_POST, 'nom_admin', FILTER_SANITIZE_STRING),
        'email_admin' => filter_input(INPUT_POST, 'email_admin', FILTER_SANITIZE_EMAIL),
        'mot_passe_admin' => filter_input(INPUT_POST, 'mot_passe_admin', FILTER_SANITIZE_STRING),
       
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
    }

    if (!empty($data['mot_passe_admin'])) {
        if (strlen($data['mot_passe_admin']) < 6) {
            $errors['mot_passe_admin'] = "Le mot de passe doit comporter au moins 6 caractères.";
        } elseif ($data['mot_passe_admin'] !== filter_input(INPUT_POST, 'confirm_mot_passe_admin', FILTER_SANITIZE_STRING)) {
            $errors['confirm_mot_passe_admin'] = "Les mots de passe ne correspondent pas.";
        } else {
            
            $hashedPassword = password_hash($data['mot_passe_admin'], PASSWORD_BCRYPT);
            $data['mot_passe_admin'] = $hashedPassword;
        }
    } else {
        unset($data['mot_passe_admin']); 
    }

    if (empty($errors)) {
        if (update_admin($data, $id, $pdo)) {
            $_SESSION['success'] = "Administrateur mis à jour avec succès.";
            header('Location: index.php?view=Admin');
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour de l'administrateur.";
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = $data;
    }
}

?>
