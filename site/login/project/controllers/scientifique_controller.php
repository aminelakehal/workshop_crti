<?php
require_once __DIR__ . '/../models/model.php';
function get_all_conscesion_scientifique($pdo)
{
    return get_all('conscesion_scientifique', $pdo);
}

function get_conscesion_scientifique_by_id($id, $pdo)
{
    return get_by_id('conscesion_scientifique','id_scientifique', $id, $pdo);
}

function add_conscesion_scientifique($data, $pdo)
{
    return insert('conscesion_scientifique','id_scientifique', $data, $pdo);
}

function update_conscesion_scientifique($data, $id, $pdo)
{
    return update('conscesion_scientifique','id_scientifique', $data, $id, $pdo);
}

function delete_conscesion_scientifique($id, $pdo)
{
    return delete('conscesion_scientifique','id_scientifique', $id, $pdo);
}
?>