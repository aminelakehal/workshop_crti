<?php


require_once __DIR__ . '/../Admin_controllers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'prenom_admin' => isset($_POST['prenom_admin']) ? trim($_POST['prenom_admin']) : '',
        'nom_admin' => isset($_POST['nom_admin']) ? trim($_POST['nom_admin']) : '',
        'email_admin' => isset($_POST['email_admin']) ? trim($_POST['email_admin']) : '',
        'Role' => 'admin', // The role is always set to 'admin'
        'mot_passe_admin' => isset($_POST['mot_passe_admin']) ? $_POST['mot_passe_admin'] : '',
    ];
    
    $errors = [];

    if (empty($data['prenom_admin']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['prenom_admin'])) {
        $errors['prenom_admin'] = "Please enter a valid first name.";
    } else {
        $data['prenom_admin'] = ucfirst(strtolower($data['prenom_admin'])); 
    }

    if (empty($data['nom_admin']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nom_admin'])) {
        $errors['nom_admin'] = "Please enter a valid last name.";
    } else {
        $data['nom_admin'] = ucfirst(strtolower($data['nom_admin'])); 
    }

    if (empty($data['email_admin']) || !filter_var($data['email_admin'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_admin'] = "Veuillez entrer un email valide."; 
    } elseif (email_exists($data['email_admin'], $pdo)) {
        $errors['email_admin'] = "Cet email est déjà utilisé."; 
    }
    

    if (empty($data['mot_passe_admin'])) {
        $errors['mot_passe_admin'] = "Please enter a password.";
    } elseif (strlen($data['mot_passe_admin']) < 8) {
        $errors['mot_passe_admin'] = "The password must be at least 8 characters long.";
    }

    if (empty($errors)) {
        $data['mot_passe_admin'] = password_hash($data['mot_passe_admin'], PASSWORD_BCRYPT);

        if (add_admin($data, $pdo)) {
            header("Location: /workshop_crti/admin_page/index.php?view=Admin"); 
            exit();
        } else {
            $_SESSION['data'] = $data;
            $_SESSION['error'] = "Error adding Admin.";
            header("Location: /workshop_crti/admin_page/index.php?view=add_admin");
            exit();
        }
    } else {
        $_SESSION['data'] = $data;
        $_SESSION['errors'] = $errors;
        header("Location: /workshop_crti/admin_page/index.php?view=add_admin");
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
