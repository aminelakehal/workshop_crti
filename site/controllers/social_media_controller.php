<?php
require_once __DIR__ . '/../models/model.php';

function get_all_social_media($pdo)
{
    return get_all('reseaux_sociaux', $pdo);
}

function get_social_media_by_id($id, $pdo)
{
    return get_by_id('reseaux_sociaux', 'id_RS', $id, $pdo);
}

function add_social_media($data, $pdo)
{
    return insert('reseaux_sociaux', $data, $pdo);
}

function update_social_media($data, $id, $pdo)
{
    return update('reseaux_sociaux', 'id_RS', $data, $id, $pdo);
}

function delete_social_media($id, $pdo)
{
    return delete('reseaux_sociaux', 'id_RS', $id, $pdo);
}
?>