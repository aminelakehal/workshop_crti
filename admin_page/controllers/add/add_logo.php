<?php

require_once __DIR__ . '/../logo_controller.php';
$errors = []; 
$file_data = [
    'logo_home' => '',
    'logo1' => '',
    'logo2' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir_logo_home = __DIR__ . '/../../../uploads_workshop/uploads_logo_site/logo_home/';
    $upload_dir_logo1 = __DIR__ . '/../../../uploads_workshop/uploads_logo_site/logo1/';
    $upload_dir_logo2 = __DIR__ . '/../../../uploads_workshop/uploads_logo_site/logo2/';
    
    foreach ([$upload_dir_logo_home, $upload_dir_logo1, $upload_dir_logo2] as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    $temp_files = [];

    $file_fields = [
        'logo2' => ['dir' => $upload_dir_logo2, 'types' => ['image/jpeg', 'image/png', 'image/gif'], 'max_size' => 5 * 1024 * 1024],
        'logo1' => ['dir' => $upload_dir_logo1, 'types' => ['image/jpeg', 'image/png', 'image/gif'], 'max_size' => 5 * 1024 * 1024],
        'logo_home' => ['dir' => $upload_dir_logo_home, 'types' => ['image/jpeg', 'image/png', 'image/gif'], 'max_size' => 5 * 1024 * 1024],
    ];

    foreach ($file_fields as $field => $config) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $temp_files[$field] = processFile($_FILES[$field], $config['dir'], $errors, $field, $config['types'], $config['max_size']);
        } else {
            $file_data[$field] = filter_input(INPUT_POST, "current_$field", FILTER_SANITIZE_STRING);
        }
    }

    if (empty($errors)) {
        foreach ($temp_files as $field => $file_info) {
            if ($file_info) {
                $final_destination = $file_info['upload_dir'] . $file_info['unique_name'];
                if (rename($file_info['temp_path'], $final_destination)) {
                    $file_data[$field] = $file_info['unique_name'];
                } else {
                    $errors[$field] = "Failed to move the file to its final location.";
                }
            }
        }

        if (empty($errors)) {
            $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
            $data = [
                'logo_home' => $file_data['logo_home'] ? '/workshop_crti/uploads_workshop/uploads_logo_site/logo_home/' . $file_data['logo_home'] : '',
                'logo1' => $file_data['logo1'] ? '/workshop_crti/uploads_workshop/uploads_logo_site/logo1/' . $file_data['logo1'] : '',
                'logo2' => $file_data['logo2'] ? '/workshop_crti/uploads_workshop/uploads_logo_site/logo2/' . $file_data['logo2'] : '',
                'id_admin' => $id_admin

            ];

            $success = add_logo($data, $pdo);
            if ($success) {
                header('Location: /workshop_crti/admin_page/index.php?view=logo');
                exit;
            } else {
                $errors['database'] = "Error adding contenu to the database.";
            }
        }
    }

    if (!empty($errors)) {
        foreach ($temp_files as $file_info) {
            if ($file_info && file_exists($file_info['temp_path'])) {
                unlink($file_info['temp_path']);
            }
        }
    }
}

function processFile($file, $upload_dir, &$errors, $field_name, $allowed_types, $max_size) {
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $unique_name = uniqid() . '.' . $file_ext;
    $temp_path = $upload_dir . 'temp_' . $unique_name;

    $file_type = mime_content_type($file['tmp_name']);

    if (!in_array($file_type, $allowed_types)) {
        $errors[$field_name] = "Invalid file type. Allowed types: " . implode(', ', $allowed_types) . ".";
        return null;
    }
    
    if ($file['size'] > $max_size) {
        $errors[$field_name] = "The file size exceeds the maximum allowed.";
        return null;
    }

    if (move_uploaded_file($file['tmp_name'], $temp_path)) {
        $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
        return [
            'temp_path' => $temp_path,
            'unique_name' => $unique_name,
            'upload_dir' => $upload_dir,
            'id_admin' => $id_admin
        ];
    } else {
        $errors[$field_name] = "Error uploading file.";
        return null;
    }
}
