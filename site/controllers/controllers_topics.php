<?php
require_once __DIR__ . '/../models/model.php';

function get_all_topics($pdo)
{
    return get_all('sujet', $pdo);
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
