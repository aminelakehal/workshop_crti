<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

function get_theme($pdo) {
    $stmt = $pdo->prepare("SELECT t.*, 
               CASE 
                   WHEN t.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM theme t
        LEFT JOIN admin a ON t.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}

function get_theme_by_id($id_theme, $pdo)
{
    return get_by_id('theme', 'id_theme', $id_theme, $pdo);
}

function add_theme($data, $pdo)
{
    return insert('theme', $data, $pdo);
}

function update_theme($data, $id_theme, $pdo)
{
    return update('theme', 'id_theme', $data, $id_theme, $pdo);
}

function delete_theme($id_theme, $pdo)
{
    return delete('theme', 'id_theme', $id_theme, $pdo);
}

// ====================== delete sponsore ====================

if (isset($_GET['id_theme'])) {
    $id_theme = $_GET['id_theme'];
    $result = delete_theme($id_theme, $pdo);
    if ($result) {
        header('Location: index.php?view=theme');
        exit;
    } else {
        echo "Failed to delete theme.";
    }
}


?>
