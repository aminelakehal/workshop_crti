<?php
require_once __DIR__ . '/../models/model.php';

function get_all_secteur($pdo)
{
    return get_all('secteur', $pdo);
}

function get_secteur_by_id($id, $pdo)
{
    return get_by_id('secteur', 'id_secteur', $id, $pdo);
}

function add_secteur($data, $pdo)
{
    return insert('secteur', $data, $pdo);
}

function update_secteur($data, $id, $pdo)
{
    return update('secteur', 'id_secteur', $data, $id, $pdo);
}

function delete_secteur($id, $pdo)
{
    return delete('secteur', 'id_secteur', $id, $pdo);
}
?>
