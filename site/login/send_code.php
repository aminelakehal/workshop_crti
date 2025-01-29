<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session'); 
    session_start();
}
require_once __DIR__ . '/../controllers/user_controller.php';
require_once __DIR__ . '/../vendor/autoload.php';

require_once 'csrf_token.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Generate a reset token
function generate_reset_token() {
    return bin2hex(random_bytes(16));
}

// Send password reset email
function send_reset_email($email, $reset_token) {
    $mail = new PHPMailer(true);
    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'louffymonkeyd@gmail.com';
        $mail->Password   = 'oiad zixs hwlq ajnm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('louffymonkeyd@gmail.com', 'CRTI');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Password Reset";
        $mail->Body    = "To reset your password, please enter the following code: <strong>$reset_token</strong>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error sending email: {$mail->ErrorInfo}");
        return false;
    }
}

// Generate CSRF token and store it in the session
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify CSRF token
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!verify_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        $user = get_user_by_email($email, $pdo);

        if ($user) {
            $reset_token = generate_reset_token();
            $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            if (update_user(['reset_token' => $reset_token, 'reset_token_expiry' => $expiry_time], $user['id_user'], $pdo)) {
                if (send_reset_email($email, $reset_token)) {
                    $_SESSION['reset_token'] = $reset_token;
                    $success_message = "A reset code has been sent to your email. Please check your inbox.";
                    header("Location: reset_password.php");
                    exit();

                } else {
                    $error_message = "We couldn't send the email. Please try again later.";
                }
            } else {
                $error_message = "An error occurred while updating user information. Please try again.";
            }
        } else {
            $error_message = "No account associated with this email address.";
        }
    }
}

// Generate CSRF token to display in the form
$csrf_token = generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .container, .container-md, .container-sm {
            max-width: 350px !important;
        }
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 250px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 2000);
    });
    </script>
</head>
<body>
    <div class="container mt-5">
        <form action="send_code.php" method="POST" autocomplete="off">
            <!-- Add hidden csrf_token field -->
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            
            <h2 class="text-center">Password Reset</h2>
            <p class="text-center">Enter your email address</p>

            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Send Verification Code</button>
            </div>

            <?php if ($error_message): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
