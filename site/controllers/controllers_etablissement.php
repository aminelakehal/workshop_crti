<?php
require_once __DIR__ . '/../models/model.php';

function get_all_etablissement($pdo)
{
    return get_all('etablissement', $pdo);
}

function get_etablissement_by_id($id, $pdo)
{
    return get_by_id('etablissement', 'id_etablissement', $id, $pdo);
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
?>
