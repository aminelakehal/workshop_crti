// controllers/RegistrationController.php
<?php
require_once __DIR__ . '/../models/model.php';

function get_registration_info($pdo)
{
    return get_all('registration_info', $pdo);
}

function get_registration_by_id($id, $pdo)
{
    return get_by_id('registration_info', 'id', $id, $pdo);
}

function add_registration_info($data, $pdo)
{
    return insert('registration_info', $data, $pdo);
}

function update_registration_info($data, $id, $pdo)
{
    return update('registration_info', 'id', $data, $id, $pdo);
}

function delete_registration_info($id, $pdo)
{
    return delete('registration_info', 'id', $id, $pdo);
}

?>
