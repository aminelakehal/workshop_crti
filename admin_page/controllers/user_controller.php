<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

function get_all_user($pdo)
{
    return get_all('user', $pdo);
}

function get_user_by_id($id, $pdo)
{
    return get_by_id('user', 'id_user', $id, $pdo);
}

function add_user($data, $pdo)
{
    return insert('user', $data, $pdo);
}

function update_user($data, $id, $pdo)
{
    return update('user', 'id_user', $data, $id, $pdo);
}

function delete_user($id, $pdo)
{
    return delete('user', 'id_user', $id, $pdo);
}
function count_users($pdo)
{
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM user');
    $stmt->execute();
    return $stmt->fetchColumn();
}
?>
