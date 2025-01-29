<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

function get_all_etablissement($pdo)
{
    $stmt = $pdo->query('
        SELECT 
            u.*,                                
            e.*,                               
            s.nom_sect AS secteur_name,        
            d.nom_div AS division_name          
        FROM 
           etablissement e
        LEFT JOIN 
           user u ON e.id_user = u.id_user
        LEFT JOIN 
            secteur s ON e.id_etablissement = s.id_etablissement
        LEFT JOIN 
            division d ON e.id_etablissement = d.id_etablissement
    ');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_uploaded_files_by_user($pdo) {
    $stmt = $pdo->query('
        SELECT 
            e.id_etablissement,
            e.etablissement,
            e.nom_etablissement,
            u.prenom,
            u.nom,
            u.email,
            u.numero_telephone,
            s.nom_sect AS secteur_name,
            d.nom_div AS division_name,
            uf.file_name,
            uf.file_path,
            uf.upload_date,
            ff.field_name
        FROM 
            etablissement e
        LEFT JOIN 
            user u ON e.id_user = u.id_user
        LEFT JOIN 
            secteur s ON e.id_etablissement = s.id_etablissement
        LEFT JOIN 
            division d ON e.id_etablissement = d.id_etablissement
        LEFT JOIN
            uploaded_files uf ON e.id_etablissement = uf.id_etablissement
        LEFT JOIN
            file_fields ff ON uf.id_file_fields = ff.id_file_fields
        ORDER BY
            e.id_etablissement, uf.upload_date DESC
    ');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}








function get_etablissement_by_id($id, $pdo)
{
    $stmt = $pdo->prepare('
        SELECT 
            u.*, 
            e.nom_etablissement AS etablissement_name, 
            s.nom_sect AS secteur_name, 
            d.nom_div AS division_name
        FROM 
           etablissement e 
        LEFT JOIN 
           user u ON e.id_user = u.id_user
        LEFT JOIN 
            secteur s ON e.id_etablissement = s.id_etablissement
        LEFT JOIN 
            division d ON e.id_etablissement = d.id_etablissement
        WHERE 
            e.id_etablissement = :id_etablissement
    ');
    $stmt->execute(['id_etablissement' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_etablissement($data, $pdo)
{
    return insert('etablissement', $data, $pdo);
}

function update_etablissement($data, $id, $pdo)
{
    return update('etablissement', 'id_etablissement', $data, $id, $pdo);
}

function delete_etablissement($id, $pdo)
{
    return delete('etablissement', 'id_etablissement', $id, $pdo);
}




function count_total_files($pdo)
{
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM etablissement');
    $stmt->execute();
    return $stmt->fetchColumn();
}






if (isset($_GET['id_etablissement'])) {
    $id_etablissement = $_GET['id_etablissement'];
    delete_etablissement($id_etablissement, $pdo);
    header('Location: index.php?view=condidates');
    exit;
}
?>
