<?php

require_once __DIR__ . '/../models/model.php';

function get_all_contenu($pdo) {
    return get_all('contenu', $pdo);
}


function get_contenu_by_id($id, $pdo) {
    return get_by_id('contenu', 'id_contenu', $id, $pdo);
}


function add_contenu($data, $pdo) {
    return insert('contenu', $data, $pdo);
}

function update_contenu($data, $id, $pdo) {
    return update('contenu', 'id_contenu', $data, $id, $pdo);
}

function delete_contenu($id, $pdo) {
    return delete('contenu', 'id_contenu', $id, $pdo);
}

?>
