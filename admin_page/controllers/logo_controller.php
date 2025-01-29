<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}


require_once __DIR__ . '/../models/model.php';


function get_all_logo($pdo) {
    $stmt = $pdo->prepare("SELECT L.*, 
               CASE 
                   WHEN L.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM logo L
        LEFT JOIN admin a ON L.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}
function get_logo_by_id($id, $pdo)
{
    return get_by_id('logo', 'id_logo', $id, $pdo);
}

function add_logo($data, $pdo)
{
    return insert('logo', $data, $pdo);
}

function update_logo($data, $id, $pdo)
{
    return update('logo', 'id_logo', $data, $id, $pdo);
}

function delete_logo($id, $pdo)
{

    $stmt = $pdo->prepare("SELECT logo_home,logo1,logo2 FROM logo WHERE id_logo = :id");
    $stmt->execute(['id' => $id]);
    $logo = $stmt->fetch();

    if ($logo && isset($logo['logo_home'], $logo['logo1'], $logo['logo2'])) {
       
        $logo_home_path = $_SERVER['DOCUMENT_ROOT'] . $logo['logo_home'];
        $logo1_path = $_SERVER['DOCUMENT_ROOT'] . $logo['logo1'];
        $logo2_path = $_SERVER['DOCUMENT_ROOT'] . $logo['logo2'];
        
      
        if (file_exists($logo_home_path)) {
            unlink($logo_home_path);
        }
    
       
        if (file_exists($logo1_path)) {
            unlink($logo1_path);
        }

        if (file_exists($logo2_path)) {
            unlink($logo2_path);
        }
    
        
        $result = delete('logo', 'id_logo', $id, $pdo);
        
        return $result;
    } else {
        return false;
    }
}


if (isset($_GET['id_logo'])) {
    $id_logo = $_GET['id_logo'];
    delete_logo($id_logo, $pdo);
    header('Location: index.php?view=logo');
    exit;
}
