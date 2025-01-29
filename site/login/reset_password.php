<?php
require_once __DIR__ . '/../controllers/user_controller.php';
require_once 'csrf_token.php';

// CSRF
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session'); 
    session_start();
}

$csrf_token = generate_csrf_token();

if (!isset($_SESSION['reset_token']) || empty($_SESSION['reset_token'])) {
    header('Location: send_code.php');
    exit;
}

$errors = [];
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $reset_token = filter_input(INPUT_POST, 'reset_token', FILTER_SANITIZE_STRING);
    $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

    if (empty($new_password)) {
        $errors['new_password'] = 'Password is required.';
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $new_password)) {
        $errors['new_password'] = 'Password must start with an uppercase letter, contain at least one number, and be at least 8 characters long.';
    }

    if ($new_password !== $confirm_password) {
        $errors['password'] = "Password and password confirmation do not match.";
    }

    if (empty($errors)) {
        $user = get_user_by_reset_token($reset_token, $pdo);

        if ($user) {
            if (strtotime($user['reset_token_expiry']) > time()) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                update_user_password($user['id_user'], $hashed_password, $pdo);
                update_user(['reset_token' => NULL, 'reset_token_expiry' => NULL], $user['id_user'], $pdo);
                $success_message = "Password changed successfully.";
                session_destroy();
                header("Location: login.php");
                exit();
            } else {
                $errors['token'] = "Reset verification code has expired.";
            }
        } else {
            $errors['token'] = "Invalid verification code.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="stylesheet" href="styl.css">
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 250px;
        }
    </style>

    <script>
    $(document).ready(function() {
        var messageDuration = 20000; 

        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, messageDuration);
    });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Set New Password</h2>
        <form action="" id="resetPasswordForm" method="POST" class="mt-4">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

            <div class="form-group">
                <label for="reset_token">Enter your verification code :</label>
                <input type="text" name="reset_token" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Change Password</button>

            <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
<?php
    unset($_SESSION);
?>
