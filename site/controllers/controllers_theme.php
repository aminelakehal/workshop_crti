<?php
require_once __DIR__ . '/../models/model.php';

function get_theme($pdo) {
    return get_all('theme', $pdo);

}

function get_theme_by_id($id_theme, $pdo)
{
    return get_by_id('theme', 'id_theme', $id_theme, $pdo);
}

function add_theme($data, $pdo)
{
    return insert('theme', $data, $pdo);
}

function update_theme($data, $id_theme, $pdo)
{
    return update('theme', 'id_theme', $data, $id_theme, $pdo);
}

function delete_theme($id_theme, $pdo)
{
    return delete('theme', 'id_theme', $id_theme, $pdo);
}

// ====================== delete sponsore ====================



?>
