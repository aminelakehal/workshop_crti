<?php
require_once __DIR__ . '/../models/model.php';


function get_all_navigateur($pdo) {
    
    return get_all('navigateur', $pdo);
}
function get_navigateur_by_id($id, $pdo)
{
    return get_by_id('navigateur', 'id_navigateur', $id, $pdo);
}

function add_navigateur($data, $pdo)
{
    return insert('navigateur', $data, $pdo);
}

function update_navigateur($data, $id, $pdo)
{
    return update('navigateur', 'id_navigateur', $data, $id, $pdo);
}

function delete_navigateur($id, $pdo)
{
    return delete('navigateur', 'id_navigateur', $id, $pdo);
}


?>
