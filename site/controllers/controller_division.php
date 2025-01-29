<?php
require_once __DIR__ . '/../models/model.php';

function get_all_division($pdo)
{
    return get_all('division', $pdo);
}

function get_division_by_id($id, $pdo)
{
    return get_by_id('division', 'id_division', $id, $pdo);
}

function add_division($data, $pdo)
{
    return insert('division', $data, $pdo);
}

function update_division($data, $id, $pdo)
{
    return update('division', 'id_division', $data, $id, $pdo);
}

function delete_division($id, $pdo)
{
    return delete('division', 'id_division', $id, $pdo);
}
?>
