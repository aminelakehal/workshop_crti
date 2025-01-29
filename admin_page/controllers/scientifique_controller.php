<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

// ======================= concession_scientific ===========================

function get_all_concession_scientific($pdo) {
    $stmt = $pdo->prepare("SELECT c.*, 
               CASE 
                   WHEN c.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM concession_scientific c
        LEFT JOIN admin a ON c.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}


function get_concession_scientific_by_id($id, $pdo)
{
    return get_by_id('concession_scientific', 'id_president_S', $id, $pdo);
}

function add_concession_scientific($data, $pdo)
{
    return insert('concession_scientific', $data, $pdo);
}

function update_concession_scientific($data, $id, $pdo)
{
    return update('concession_scientific', 'id_president_S', $data, $id, $pdo);
}

function delete_concession_scientific($id, $pdo)
{
    return delete('concession_scientific', 'id_president_S', $id, $pdo);
}

// ======================= membres_scientific ===========================

function get_all_membres_scientific($pdo) {
    $stmt = $pdo->prepare("SELECT m.*, 
               CASE 
                   WHEN m.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM membres_scientific m
        LEFT JOIN admin a ON m.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}

function get_membres_scientific_by_id($id, $pdo)
{
    return get_by_id('membres_scientific', 'id_membres_S', $id, $pdo);
}

function add_membres_scientific($data, $pdo)
{
    return insert('membres_scientific', $data, $pdo);
}

function update_membres_scientific($data, $id, $pdo)
{
    return update('membres_scientific', 'id_membres_S', $data, $id, $pdo);
}

function delete_membres_scientific($id, $pdo)
{
    return delete('membres_scientific', 'id_membres_S', $id, $pdo);
}

// ======================= vice_president_scientific ===========================

function get_all_vice_president_scientific($pdo) {
    $stmt = $pdo->prepare("SELECT V.*, 
               CASE 
                   WHEN V.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM vice_president_scientific V
        LEFT JOIN admin a ON V.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}

function get_vice_president_scientific_by_id($id, $pdo)
{
    return get_by_id('vice_president_scientific', 'id_Vpresident_S', $id, $pdo);
}

function add_vice_president_scientific($data, $pdo)
{
    return insert('vice_president_scientific', $data, $pdo);
}

function update_vice_president_scientific($data, $id, $pdo)
{
    return update('vice_president_scientific', 'id_Vpresident_S', $data, $id, $pdo);
}

function delete_vice_president_scientific($id, $pdo)
{
    return delete('vice_president_scientific', 'id_Vpresident_S', $id, $pdo);
}
?>