<?php
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

function get_user_by_email($email, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_user_by_reset_token($reset_token, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE reset_token = :reset_token");
    $stmt->bindParam(':reset_token', $reset_token);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



function update_user_password($id_user, $hashed_password, $pdo) {
    $stmt = $pdo->prepare("UPDATE user SET mot_de_passe = ? WHERE id_user = ?");
    $stmt->execute([$hashed_password, $id_user]);
}
?>
