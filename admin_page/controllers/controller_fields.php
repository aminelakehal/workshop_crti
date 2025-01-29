<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';


function get_all_file_data($pdo) {
    return get_all('uploaded_files', $pdo);
}

function get_file_data($id, $pdo) {
    return get_by_id('uploaded_files', 'id_uploaded_files', $id, $pdo);
}

function add_file_data($data, $pdo) {
    return insert('uploaded_files', $data, $pdo);
}

function update_file_data($data, $id, $pdo) {
    return update('uploaded_files', 'id_uploaded_files', $data, $id, $pdo);
}

function delete_file_data($id, $pdo) {
    return delete('uploaded_files', 'id_uploaded_files', $id, $pdo);
}




function get_all_file_fields($pdo) {
    return get_all('file_fields', $pdo);
}

function get_file_fields($id, $pdo) {
    return get_by_id('file_fields', 'id_file_fields', $id, $pdo);
}

function add_file_fields($data, $pdo) {
    return insert('file_fields', $data, $pdo);
}

function update_file_fields($data, $id, $pdo) {
    return update('file_fields', 'id_file_fields', $data, $id, $pdo);
}

function delete_file_fields($id, $pdo) {
    return delete('file_fields', 'id_file_fields', $id, $pdo);
}



if (isset($_GET['id_file_fields'])) {
    $id_file_fields = $_GET['id_file_fields'];
    delete_file_fields($id_file_fields, $pdo);
    header('Location: index.php?view=fields');
    exit;
}

?>




