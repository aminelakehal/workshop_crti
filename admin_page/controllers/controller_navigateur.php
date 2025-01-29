<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}

require_once __DIR__ . '/../models/model.php';

// ====================== Récupérer tous les navigateurs ====================
function get_all_navigateur($pdo) {
    $stmt = $pdo->prepare("SELECT N.*, 
               CASE 
                   WHEN N.id_admin IS NULL THEN 'super admin'
                   ELSE CONCAT(a.prenom_admin, ' ', a.nom_admin)
               END AS admin_name
        FROM navigateur N
        LEFT JOIN admin a ON N.id_admin = a.id_admin"); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}

// ====================== Récupérer un navigateur par ID ====================
function get_navigateur_by_id($id, $pdo) {
    return get_by_id('navigateur', 'id_navigateur', $id, $pdo);
}

// ====================== Ajouter un navigateur ====================
function add_navigateur($data, $pdo) {
    return insert('navigateur', $data, $pdo);
}

// ====================== Mettre à jour un navigateur ====================
function update_navigateur($data, $id, $pdo) {
    return update('navigateur', 'id_navigateur', $data, $id, $pdo);
}

// ====================== Supprimer un navigateur ====================
function delete_navigateur($id, $pdo) {
    // Récupère le chemin de l'image pour l'enregistrement spécifié
    $stmt = $pdo->prepare("SELECT image_navigateur FROM navigateur WHERE id_navigateur = :id");
    $stmt->execute(['id' => $id]);
    $navigateur = $stmt->fetch();

    if ($navigateur && isset($navigateur['image_navigateur'])) {
        // Traite chaque chemin séparément
        $image_path = $_SERVER['DOCUMENT_ROOT'] . $navigateur['image_navigateur'];

        // Supprime l'image si elle existe
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Continue avec les autres opérations...
        $result = delete('navigateur', 'id_navigateur', $id, $pdo);
        return $result;
    } else {
        return false;
    }
}

// ====================== Script de suppression (en bas de fichier) ====================
if (isset($_GET['id_navigateur'])) {
    $id_navigateur = $_GET['id_navigateur'];
    $result = delete_navigateur($id_navigateur, $pdo);
    if ($result) {
        header('Location: index.php?view=navigateur');
        exit;
    } else {
        echo "Échec de la suppression du navigateur.";
    }
}

?>
