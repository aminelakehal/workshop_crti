<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';


function get_all_color_site($pdo) {
    return get_all('color_site', $pdo);
}

function get_color_site($id, $pdo) {
    return get_by_id('color_site', 'id_color', $id, $pdo);
}

function add_color_site($data, $pdo) {
    return insert('color_site', $data, $pdo);
}

function update_color_site($data, $id, $pdo) {
    return update('color_site', 'id_color', $data, $id, $pdo);
}


function delete_color_site($id, $pdo) {
    return delete('color_site', 'id_color', $id, $pdo);
}

if (isset($_GET['id_color'])) {
    $id_color = $_GET['id_color'];
    delete_color_site($id_color, $pdo);
    header('Location: index.php?view=color');
    exit;
}







?>