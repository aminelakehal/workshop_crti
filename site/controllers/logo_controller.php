<?php
require_once __DIR__ . '/../models/model.php';


function get_all_logo($pdo) {
    return get_all('logo', $pdo);
}
function get_logo_by_id($id, $pdo)
{
    return get_by_id('logo', 'id_logo', $id, $pdo);
}

function add_logo($data, $pdo)
{
    return insert('logo', $data, $pdo);
}

function update_logo($data, $id, $pdo)
{
    return update('logo', 'id_logo', $data, $id, $pdo);
}

function delete_logo($id, $pdo)
{
    return delete('logo', 'id_logo', $id, $pdo);
}


