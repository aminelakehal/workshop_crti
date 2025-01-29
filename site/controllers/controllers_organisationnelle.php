
<?php

require_once __DIR__ . '/../models/model.php';

// ======================= membres_organisationnelle ===========================
function get_all_membres_organisationnelle($pdo) {
    return get_all('membres_organisationnelle', $pdo);
}

function get_membres_organisationnelle_by_id($id, $pdo)
{
    return get_by_id('membres_organisationnelle', 'id_membres_O', $id, $pdo);
}

function add_membres_organisationnelle($data, $pdo)
{
    return insert('membres_organisationnelle', $data, $pdo);
}

function update_membres_organisationnelle($data, $id, $pdo)
{
    return update('membres_organisationnelle', 'id_membres_O', $data, $id, $pdo);
}

function delete_membres_organisationnelle($id, $pdo)
{
    return delete('membres_organisationnelle', 'id_membres_O', $id, $pdo);
}



// ======================= president_organisationnelle ===========================


function get_all_concession_organisationnelle($pdo) {
    return get_all('concession_organisationnelle', $pdo);
}



function get_president_organisationnelle_by_id($id, $pdo) {
    return get_by_id('concession_organisationnelle', 'id_president_O', $id, $pdo);     
}


function add_president_organisationnelle($data, $pdo) {
    return insert('concession_organisationnelle', $data, $pdo);
}


function update_president_organisationnelle($data, $id, $pdo) {
    return update('concession_organisationnelle', 'id_president_O', $data, $id, $pdo);  
}


function delete_president_organisationnelle($id, $pdo) {
    return delete('concession_organisationnelle', 'id_president_O', $id, $pdo);  
}



// ======================= vice_president_organisationnelle ===========================


function get_all_vice_president_organisationnelle($pdo) {
        return get_all('vice_president_organisationnelle', $pdo);
    }
    

function get_vice_president_organisationnelle_by_id($id, $pdo)
{
    return get_by_id('vice_president_organisationnelle', 'id_vice_president_o', $id, $pdo);
}

function add_vice_president_organisationnelle($data, $pdo)
{
    return insert('vice_president_organisationnelle', $data, $pdo);
}

function update_vice_president_onorganisationnelle($data, $id, $pdo)
{
    return update('vice_president_organisationnelle', 'id_vice_president_o', $data, $id, $pdo);
}

function delete_vice_president_onorganisationnelle($id, $pdo)
{
    return delete('vice_president_organisationnelle', 'id_vice_president_o', $id, $pdo);
}
?>
