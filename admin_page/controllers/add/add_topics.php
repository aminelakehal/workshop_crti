<?php
require_once __DIR__ . '/../controllers_topics.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
    
    $design_sujet_raw = isset($_POST['design_sujet']) ? trim($_POST['design_sujet']) : '';
    
    $design_sujets = array_map('trim', explode('.', $design_sujet_raw));
    
    $errors = [];
    
    foreach ($design_sujets as $design_sujet) {
      
        if (!empty($design_sujet)) {
            $data = [
                'design_sujet' => ucfirst(strtolower($design_sujet)),
                'id_admin' => $id_admin
            ];
            
            if (!add_topics($data, $pdo)) {
                $errors['design_sujet'] = "Error adding some topics.";
            }
        }
    }

    if (empty($errors)) {
        $_SESSION['success'] = "Topics added successfully!";
        header("Location: /workshop_crti/admin_page/index.php?view=add_topic");
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['data'] = ['design_sujet' => $design_sujet_raw];
        header("Location: /workshop_crti/admin_page/index.php?view=add_topic");
        exit();
    }
}
