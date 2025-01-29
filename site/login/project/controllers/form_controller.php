<?php
require_once __DIR__ . '/../models/model.php';

function get_all_form_fields($pdo)
{
    return get_all('form_fields', $pdo);
}

function get_form_fields_by_id($id, $pdo)
{
    return get_by_id('form_fields', 'id_form_fields', $id, $pdo);
}

function add_form_fields($data, $pdo)
{
    return insert('form_fields', $data, $pdo);
}

function update_form_fields($data, $id, $pdo)
{
    return update('form_fields', 'id_form_fields', $data, $id, $pdo);
}

function delete_form_fields($id, $pdo)
{
    return delete('form_fields', 'id_form_fields', $id, $pdo);
}

?>
