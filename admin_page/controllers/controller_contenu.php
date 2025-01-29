<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

function get_all_contenu($pdo) {
    $stmt = $pdo->prepare("SELECT c.*, 
    CASE 
        WHEN c.id_admin IS NULL THEN 'super admin'
        ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
    END AS admin_name
FROM contenu c
LEFT JOIN admin a ON c.id_admin = a.id_admin"); 
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}


function get_contenu_by_id($id, $pdo) {
    return get_by_id('contenu', 'id_contenu', $id, $pdo);
}


function add_contenu($data, $pdo) {
    return insert('contenu', $data, $pdo);
}

function update_contenu($data, $id, $pdo) {
    return update('contenu', 'id_contenu', $data, $id, $pdo);
}



function delete_contenu($id, $pdo)
{
    // Retrieves the image path for the specified record
    $stmt = $pdo->prepare("SELECT video_src, download_link, about_image FROM contenu WHERE id_contenu = :id");
    $stmt->execute(['id' => $id]);
    $contenu = $stmt->fetch();

    if ($contenu && isset($contenu['about_image'], $contenu['download_link'], $contenu['video_src'])) {
        // Handle each path separately
        $image_path = $_SERVER['DOCUMENT_ROOT'] . $contenu['about_image'];
        $video_path = $_SERVER['DOCUMENT_ROOT'] . $contenu['video_src'];
        $download_path = $_SERVER['DOCUMENT_ROOT'] . $contenu['download_link'];
        
        // Example: Delete image if it exists
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    
        // Example: Delete video if it exists
        if (file_exists($video_path)) {
            unlink($video_path);
        }

        if (file_exists($download_path)) {
            unlink($download_path);
        }
    
        // Continue with other operations...
        $result = delete('contenu', 'id_contenu', $id, $pdo);
        
        return $result;
    } else {
        return false;
    }
}
// ====================== delete  ====================

if (isset($_GET['id_contenu'])) {
    $id_contenu = $_GET['id_contenu'];
    $result = delete_contenu($id_contenu, $pdo);
    if ($result) {
        header('Location: index.php?view=contenu');
        exit;
    } else {
        echo "Failed to delete contenu.";
    }
}

?>
