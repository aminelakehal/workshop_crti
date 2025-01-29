<?php
require_once __DIR__ . '/../models/model.php';

function get_all_users($pdo)
{
    $stmt = $pdo->query('
        SELECT user.*, 
               etablissement.nom_etablissement AS etablissement_name, 
               secteur.nom_sect AS secteur_name, 
               division.nom_div AS division_name
        FROM user
        LEFT JOIN etablissement ON user.id_etablissement = etablissement.id_etablissement
        LEFT JOIN secteur ON etablissement.id_secteur = secteur.id_secteur
        LEFT JOIN division ON etablissement.id_etablissement = division.id_etablissement
    ');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user_by_id($id, $pdo)
{
    $stmt = $pdo->prepare('
        SELECT user.*, 
               etablissement.nom_etablissement AS etablissement_name, 
               secteur.nom_sect AS secteur_name, 
               division.nom_div AS division_name
        FROM user
        LEFT JOIN etablissement ON user.id_etablissement = etablissement.id_etablissement
        LEFT JOIN secteur ON etablissement.id_secteur = secteur.id_secteur
        LEFT JOIN division ON etablissement.id_etablissement = division.id_etablissement
        WHERE user.id_user = :id_user
    ');
    $stmt->execute(['id_user' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function add_user($data, $pdo)
{
    return insert('user', $data, $pdo);
}

function update_user($data, $id, $pdo)
{
    return update('user', 'id_user', $data, $id, $pdo);
}


function delete_user($id, $pdo)
{
    return delete('user', 'id_user', $id, $pdo);
}
?>
