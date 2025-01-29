<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session');
    session_start();
}
require_once __DIR__ . '/../controllers/user_controller.php';

$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$password = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
$errors = [];


if (empty($email)) {
    $errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format';
} else {
    $user = get_user_by_email($email, $pdo);
    if (!$user) {
        $errors['email'] = 'Email not found';
    }
}


if (empty($password)) {
    $errors['mot_de_passe'] = 'Password is required';
} elseif (!isset($user) || !password_verify($password, $user['mot_de_passe'])) {
    if (!isset($errors['email'])) {
      
        $errors['mot_de_passe'] = 'Incorrect password. Please try again.';
    }
}


if (empty($errors)) {
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['email'] = $email;
    $_SESSION['nom'] = $user['nom']; 
    $_SESSION['prenom'] = $user['prenom']; 
    header('Location: /workshop_crti/site/index.php');
    exit();
}


$_SESSION['errors'] = $errors;
$_SESSION['data']['email'] = $email;


header('Location: login.php');
exit();
?>
