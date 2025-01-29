
<?php

require_once __DIR__ . '/../models/model.php';

// ======================= membres_scientific ===========================
function get_all_membres_scientific($pdo) {
    return get_all('membres_scientific', $pdo);
}

function get_membres_scientific_by_id($id, $pdo)
{
    return get_by_id('membres_scientific', 'id_membres_S', $id, $pdo);
}

function add_membres_scientific($data, $pdo)
{
    return insert('membres_scientific', $data, $pdo);
}

function update_membres_scientific($data, $id, $pdo)
{
    return update('membres_scientific', 'id_membres_S', $data, $id, $pdo);
}

function delete_membres_scientific($id, $pdo)
{
    return delete('membres_scientific', 'id_membres_S', $id, $pdo);
}



// ======================= president_scientific ===========================


function get_all_president_scientific($pdo) {
    return get_all('concession_scientific', $pdo);
}



function get_president_scientific_by_id($id, $pdo) {
    return get_by_id('concession_scientific', 'id_Vpresident_S', $id, $pdo);     
}


function add_president_scientific($data, $pdo) {
    return insert('concession_scientific', $data, $pdo);
}


function update_president_scientific($data, $id, $pdo) {
    return update('concession_scientific', 'id_Vpresident_S', $data, $id, $pdo);  
}


function delete_president_scientific($id, $pdo) {
    return delete('concession_scientific', 'id_president_S', $id, $pdo);  
}



// ======================= vice_president_scientific ===========================


function get_all_vice_president_scientific($pdo) {
        return get_all('vice_president_scientific', $pdo);
    }
    

function get_vice_president_scientific_by_id($id, $pdo)
{
    return get_by_id('vice_president_scientific', 'id_Vpresident_S', $id, $pdo);
}

function add_vice_president_scientific($data, $pdo)
{
    return insert('vice_president_scientific', $data, $pdo);
}

function update_vice_president_onscientific($data, $id, $pdo)
{
    return update('vice_president_scientific', 'id_Vpresident_S', $data, $id, $pdo);
}

function delete_vice_president_onscientific($id, $pdo)
{
    return delete('vice_president_scientific', 'id_Vpresident_S', $id, $pdo);
}
?>
