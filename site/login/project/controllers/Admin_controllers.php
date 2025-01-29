<?php
require_once __DIR__ . '/../models/model.php';

function get_all_admin($pdo)
{
    return get_all('admin', $pdo);
}

function get_admin_by_id($id, $pdo)
{
    return get_by_id('admin', 'id_admin', $id, $pdo);
}

function add_admin($data, $pdo)
{
    return insert('admin', $data, $pdo);
}

function update_admin($data, $id, $pdo)
{
    return update('admin', 'id_admin', $data, $id, $pdo);
}

function delete_admin($id, $pdo)
{
    return delete('admin', 'id_admin', $id, $pdo);
}

function get_admin_by_email($email, $pdo)
{
    $stmt = $pdo->prepare('SELECT * FROM admin WHERE email_admin = :email_admin');
    $stmt->execute(['email_admin' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
