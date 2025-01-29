<?php
require_once __DIR__ . '/../models/model.php';

function get_all_sponsore($pdo)
{
    return get_all('sponsore', $pdo);
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
    return delete('sponsore', 'id_sponsore', $id, $pdo);
}
?>