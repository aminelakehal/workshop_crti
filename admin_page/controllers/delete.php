<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../core/router.php';
require_once __DIR__ . '/../controllers/Admin_controllers.php';
require_once __DIR__ . '/../controllers/user_controller.php';
require_once __DIR__ . '/../controllers/organisationnelle_controllers.php';
require_once __DIR__ . '/../controllers/scientifique_controller.php';



// <======================== delete user =========================>
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    delete_user($id_user, $pdo);
    header('Location: index.php?view=user');
    exit;
}

// <======================== delete Admin =========================>
if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];
    delete_admin($id_admin, $pdo);
    header('Location: index.php?view=Admin');
    exit;
}
// <======================== delete scientifique =========================>
if (isset($_GET['id_president_S'])) {
    $id_president_S  = $_GET['id_president_S'];
    delete_concession_scientific($id_president_S , $pdo);
    header('Location: index.php?view=scientifique');
    exit;
    }
// <======================== delete membres_scientific =========================>
if (isset($_GET['id_membres_S'])) {
    $id_membres_S  = $_GET['id_membres_S'];
    delete_membres_scientific($id_membres_S , $pdo);
    header('Location: index.php?view=scientifique');
    exit;
    }

// <======================== delete vice_president_scientific =========================>
if (isset($_GET['id_Vpresident_S'])) {
    $id_Vpresident_S  = $_GET['id_Vpresident_S'];
    delete_vice_president_scientific($id_Vpresident_S, $pdo);
    header('Location: index.php?view=scientifique');
    exit;
    }






// <======================== delete membres organisationnelle =========================>
if (isset($_GET['id_membres_O'])) {
    $id_membres_O = $_GET['id_membres_O'];
    delete_membres_organisationnelle($id_membres_O, $pdo);
    header('Location: index.php?view=organisationnelle');
    exit;
    }
// <======================== delete president organisationnelle=========================>
    if (isset($_GET['id_president_O'])) {
        $id_president_O = $_GET['id_president_O'];
        delete_president_organisationnelle($id_president_O, $pdo);
        header('Location: index.php?view=organisationnelle');
        exit;
        }

        // <======================== delete vice_president_organisationnelle=========================>
    if (isset($_GET['id_vice_president_o'])) {
        $id_vice_president_o = $_GET['id_vice_president_o'];
        delete_vice_president_onorganisationnelle($id_vice_president_o, $pdo);
        header('Location: index.php?view=organisationnelle');
        exit;
        }
?>