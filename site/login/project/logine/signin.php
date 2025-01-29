<?php
session_start();
require_once __DIR__ . '/../controllers/Admin_controllers.php';
require_once __DIR__ . '/../core/router.php';

function handle_admin_login($pdo)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email_admin'];
        $user_password = $_POST['mot_passe_admin'];

        // Vérification manuelle pour le super admin
        if ($email === 'stivanemaikel@gmail.com' && $user_password === '12345678') {
            $_SESSION['id_admin'] = '1'; // Assurez-vous que cet ID est unique et valide
            $_SESSION['email_admin'] = $email;
            $_SESSION['name_admin'] = 'Stivane'; // Nom du super admin
            $_SESSION['surname_admin'] = 'Maikel'; // Prénom du super admin
            $_SESSION['Role'] = 'super_admin';
            header("Location: index.php?view=user");
            exit();
        }

        // Rechercher l'admin dans la base de données
        $admin = get_admin_by_email($email, $pdo);

        if ($admin) {
            // Utiliser password_verify pour comparer le mot de passe entré avec le mot de passe hashé dans la base de données
            if (password_verify($user_password, $admin['mot_passe_admin'])) {
                $_SESSION['id_admin'] = $admin['id_admin'];
                $_SESSION['email_admin'] = $email;
                $_SESSION['Role'] = $admin['Role'];

                switch ($admin['Role']) {
                    case 'super_admin':
                        header("Location: index.php?view=user");
                        exit();
                    case 'admin':
                        header("Location: index.php?view=user");
                        exit();
                    case 'suvire':
                        header("Location: ");
                        exit();
                    default:
                        echo "Rôle inconnu";
                        exit();
                }
            } else {
                echo "Email ou mot de passe incorrect";
            }
        } else {
            echo "Email ou mot de passe incorrect";
        }
    }
}

handle_admin_login($pdo);
?>
