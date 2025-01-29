<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';


function get_all_topics($pdo) {
    $stmt = $pdo->prepare("SELECT s.*, 
               CASE 
                   WHEN s.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM sujet s
        LEFT JOIN admin a ON s.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}



function get_topics_by_id($id, $pdo)
{
    return get_by_id('sujet', 'id_sujet', $id, $pdo);
}

function add_topics($data, $pdo)
{
    return insert('sujet', $data, $pdo);
}

function update_topics($data, $id, $pdo)
{
    return update('sujet', 'id_sujet', $data, $id, $pdo);
}

function delete_topics($id, $pdo)
{
    return delete('sujet', 'id_sujet', $id, $pdo);
}


if (isset($_GET['id_sujet'])) {
    $id_sujet = $_GET['id_sujet'];
    delete_topics($id_sujet, $pdo);
    header('Location: index.php?view=topic');
    exit;
}
