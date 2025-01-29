<?php

if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "workshop";
$dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

function getPdo() {
    global $dsn, $username, $password, $options;
    try {
        return new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}

$pdo = getPdo();

function get_all($table, $pdo)
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        throw new Exception("Invalid table name");
    }

    $stmt = $pdo->query("SELECT * FROM $table");
    return $stmt->fetchAll();
}

function get_by_id($table, $id_column, $id, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $id_column = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function insert($table, $data, $pdo)
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        throw new Exception("Invalid table name");
    }

    $keys = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));
    $stmt = $pdo->prepare("INSERT INTO $table ($keys) VALUES ($placeholders)");
    return $stmt->execute($data);
}

function update($table, $id_column, $data, $id, $pdo)
{
    $fields = '';
    foreach ($data as $key => $value) {
        $fields .= "$key = :$key, ";
    }
    $fields = rtrim($fields, ', ');
    $data['id'] = $id;
    $stmt = $pdo->prepare("UPDATE $table SET $fields WHERE $id_column = :id");
    return $stmt->execute($data);
}

function delete($table, $id_column, $id, $pdo)
{
    $stmt = $pdo->prepare("DELETE FROM $table WHERE $id_column = :id");
    return $stmt->execute(['id' => $id]);
}

?>
