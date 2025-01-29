<?php
require_once __DIR__ . '/../models/model.php';

function get_all_user($pdo)
{
    $stmt = $pdo->query("SELECT u.*, a.nom_admin AS nom_admin, a.prenom_admin AS prenom_admin
                         FROM user u
                         LEFT JOIN admin a ON u.id_admin = a.id_admin");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_user_by_id($id, $pdo)
{
    return get_by_id('user', 'id_user', $id, $pdo);
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