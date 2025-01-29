<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session'); 
    session_start();
}
require_once __DIR__ . '/../controllers/user_controller.php';

// CSRF token validation
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token.');
}

// Collect POST data
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];
$numero_telephone = $_POST['numero_telephone'];

$errors = [];

// Validation of fields
if (empty($prenom)) {
    $errors['prenom'] = 'First Name is required';
} elseif (!preg_match('/^[a-zA-ZÀ-ÿ\s-]+$/', $prenom)) {
    $errors['prenom'] = 'First Name must contain only letters and spaces.';
} elseif (strlen($prenom) > 15) {
    $errors['prenom'] = 'First Name must not exceed 15 characters.';
}

if (empty($nom)) {
    $errors['nom'] = 'Last Name is required';
} elseif (!preg_match('/^[a-zA-ZÀ-ÿ\s-]+$/', $nom)) {
    $errors['nom'] = 'Last Name must contain only letters and spaces.';
} elseif (strlen($nom) > 15) {
    $errors['nom'] = 'Last Name must not exceed 15 characters.';
}

if (empty($email)) {
    $errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format';
}

if (empty($mot_de_passe)) {
    $errors['mot_de_passe'] = 'Password is required';
} elseif (!preg_match('/^[A-Z](?=.*\d).{7,}$/', $mot_de_passe)) {
    $errors['mot_de_passe'] = 'Password must start with an uppercase letter, contain at least one digit, and be at least 8 characters long.';
}

if (empty($numero_telephone) || !preg_match('/^(05|06|07)[0-9]{8}$/', $numero_telephone)) {
    $errors['numero_telephone'] = 'Phone Number must start with 05, 06, or 07 and be followed by 8 digits.';
}

// Check if the email already exists
if (get_user_by_email($email, $pdo)) {
    $errors['email'] = 'Email already exists.';
}



if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['data'] = $_POST;
    header('Location: register.php');
    exit();
}

// Hash the password
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

// Prepare data for insertion
$data = [
    'prenom' => $prenom,
    'nom' => $nom,
    'email' => $email,
    'mot_de_passe' => $mot_de_passe_hash,
    'numero_telephone' => $numero_telephone
];

// Insert the user into the database
if (insert('user', $data, $pdo)) {
    // Set a success message
    $_SESSION['success'] = 'Registration successful. You can now log in.';
    header('Location: register.php');
    exit();
} else {
    die('Failed to register user.');
}
?>
