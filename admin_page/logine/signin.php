<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session');
    session_start();
}

require_once __DIR__ . '/../controllers/Admin_controllers.php';
require_once __DIR__ . '/../core/router.php';

function handle_admin_login($pdo)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email_admin'];
        $user_password = $_POST['mot_passe_admin'];

        if ($email === 'crti@gmail.com' && $user_password === '123456789') {
            $_SESSION['id_admin'] = '1'; 
            $_SESSION['email_admin'] = $email;
            $_SESSION['name_admin'] = 'super'; 
            $_SESSION['surname_admin'] = 'admin'; 
            $_SESSION['Role'] = 'super_admin';
            header("Location: index.php?view=dashboard");
            exit();
        }

        $admin = get_admin_by_email($email, $pdo);

        if ($admin) {
            if (password_verify($user_password, $admin['mot_passe_admin'])) {
                $_SESSION['id_admin'] = $admin['id_admin'];
                $_SESSION['nom_admin'] = $admin['nom_admin']; 
                $_SESSION['prenom_admin'] = $admin['prenom_admin']; 
                $_SESSION['email_admin'] = $email;
                $_SESSION['Role'] = $admin['Role'];

                switch ($admin['Role']) {
                    case 'admin':
                        header("Location: index.php?view=dashboard");
                        exit();
                    default:
                        $_SESSION['email_error'] = "Unknown role for this email.";
                        header("Location: index.php");
                        exit();
                }
            } else {
                $_SESSION['password_error'] = "Incorrect password.";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['email_error'] = "email does not exist";
            header("Location: index.php");
            exit();
        }
    }
}

handle_admin_login($pdo);
?>
