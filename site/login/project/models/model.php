<?php
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

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

function get_all($table, $pdo)
{
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
