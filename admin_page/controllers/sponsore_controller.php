<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';


function get_all_sponsore($pdo) {
    $stmt = $pdo->prepare("SELECT s.*, 
               CASE 
                   WHEN s.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM sponsore s
        LEFT JOIN admin a ON s.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}
function get_sponsore_by_id($id, $pdo)
{
    return get_by_id('sponsore', 'id_sponsore', $id, $pdo);
}

function add_sponsore($data, $pdo)
{
    return insert('sponsore', $data, $pdo);
}

function update_sponsore($data, $id, $pdo)
{
    return update('sponsore', 'id_sponsore', $data, $id, $pdo);
}

function delete_sponsore($id, $pdo)
{
    // Retrieves the image path for the specified record
    $stmt = $pdo->prepare("SELECT URL_imag_spon FROM sponsore WHERE id_sponsore = :id");
    $stmt->execute(['id' => $id]);
    $sponsor = $stmt->fetch();

    if ($sponsor && isset($sponsor['URL_imag_spon'])) {
        // Specify the relative path of the image
        $relative_path = $sponsor['URL_imag_spon'];
        
        // Specify the full path to the image
        $image_path = $_SERVER['DOCUMENT_ROOT'] . $relative_path;
        
       
        $result = delete('sponsore', 'id_sponsore', $id, $pdo);
        
        if ($result) {
            // Check the existence of the image and delete it if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        
        return $result;
    } else {
        return false;
    }
}

// ====================== delete sponsore ====================

if (isset($_GET['id_sponsore'])) {
    $id_sponsore = $_GET['id_sponsore'];
    $result = delete_sponsore($id_sponsore, $pdo);
    if ($result) {
        header('Location: index.php?view=sponsore');
        exit;
    } else {
        echo "Failed to delete sponsor.";
    }
}

?>