<?php
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
if (isset($_GET['id_scientifique'])) {
    $id_scientifique = $_GET['id_scientifique'];
    delete_conscesion_scientifique($id_scientifique, $pdo);
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
?>