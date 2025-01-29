<?php

require_once __DIR__ . '/../sponsore_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['URL_imag_spon'])) {
   
    $upload_dir = __DIR__ . '/../../../uploads_workshop/uploads_sponsore/';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 2 * 1024 * 1024; 
    $errors = [];
    $uploaded_files = [];

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    foreach ($_FILES['URL_imag_spon']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['URL_imag_spon']['name'][$key];
        $file_type = $_FILES['URL_imag_spon']['type'][$key];
        $file_size = $_FILES['URL_imag_spon']['size'][$key];
        $file_tmp = $_FILES['URL_imag_spon']['tmp_name'][$key];
        
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Invalid file type for file: $file_name. Only JPEG, PNG, and GIF are allowed.";
            continue;
        }
        
        if ($file_size > $max_size) {
            $errors[] = "File size exceeds the maximum allowed size of 2MB for file: $file_name.";
            continue;
        }

        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_name = uniqid() . '.' . $file_ext;
        $upload_file = $upload_dir . $unique_name;

        if (move_uploaded_file($file_tmp, $upload_file)) {
            $uploaded_files[] = '/workshop_crti/uploads_workshop/uploads_sponsore/' . $unique_name;
        } else {
            $errors[] = "Error uploading file: $file_name.";
        }
    }

    if (!empty($uploaded_files)) {
        $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);

        foreach ($uploaded_files as $file_url) {
            $data = [
                'URL_imag_spon' => $file_url,
                'id_admin' => $id_admin
            ];

            $success = add_sponsore($data, $pdo);
            if (!$success) {
                $errors[] = "Error adding sponsor for file: $file_url.";
            }
        }

        if (empty($errors)) {
            header('Location: /workshop_crti/admin_page/index.php?view=sponsore');
            exit;
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>
