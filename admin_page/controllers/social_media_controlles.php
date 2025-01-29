<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

function get_all_social_media($pdo)
{
    $stmt = $pdo->prepare("SELECT r.*, 
    CASE 
        WHEN r.id_admin IS NULL THEN 'super admin'
        ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
    END AS admin_name
FROM reseaux_sociaux r
LEFT JOIN admin a ON r.id_admin = a.id_admin"); 
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}
function get_social_media_by_id($id, $pdo)
{
    return get_by_id('reseaux_sociaux', 'id_RS', $id, $pdo);
}

function add_social_media($data, $pdo)
{
    return insert('reseaux_sociaux', $data, $pdo);
}

function update_social_media($data, $id, $pdo)
{
    return update('reseaux_sociaux', 'id_RS', $data, $id, $pdo);
}

function delete_social_media($id, $pdo)
{
    return delete('reseaux_sociaux', 'id_RS', $id, $pdo);
}
// ====================== delete sponsore ====================

if (isset($_GET['id_RS'])) {
    $id_RS = $_GET['id_RS'];
    $result = delete_social_media($id_RS, $pdo);
    if ($result) {
        header('Location: index.php?view=social_media');
        exit;
    } else {
        echo "Failed to delete sponsor.";
    }
}

?>