<?php

require_once __DIR__ . '/../controller_navigateur.php';


$errors = [];
$file_data = [
    'image_navigateur' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir_images = __DIR__ . '/../../ressource/navigateur/';

    if (!is_dir($upload_dir_images)) {
        if (!mkdir($upload_dir_images, 0755, true)) {
            $errors['directory'] = "Failed to create directory.";
        }
    }

    $title_navigateur = filter_input(INPUT_POST, 'title_navigateur', FILTER_SANITIZE_STRING);
    
    if (empty($title_navigateur)) {
        $errors['title_navigateur'] = "Title is required.";
    }

    $temp_files = [];

    // Process file uploads
    $file_fields = [
        'image_navigateur' => ['dir' => $upload_dir_images, 'types' => ['image/jpeg', 'image/png', 'image/gif'], 'max_size' => 5 * 1024 * 1024],
    ];

    foreach ($file_fields as $field => $config) {
        if (isset($_FILES[$field])) {
            $upload_error = $_FILES[$field]['error'];
            if ($upload_error === UPLOAD_ERR_OK) {
                $temp_files[$field] = processFile($_FILES[$field], $config['dir'], $errors, $field, $config['types'], $config['max_size']);
            } elseif ($upload_error === UPLOAD_ERR_NO_FILE) {
                $errors[$field] = "No file was uploaded.";
            } else {
                $errors[$field] = "Error uploading file. Error code: $upload_error.";
            }
        } else {
            $errors[$field] = "File input not found.";
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
                    error_log("Failed to move file from {$file_info['temp_path']} to {$final_destination}");
                }
            }
        }

        if (empty($errors)) {
            $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);
            $data = [
                'image_navigateur' => $file_data['image_navigateur'] ? '/workshop_crti/admin_page/ressource/navigateur/' . $file_data['image_navigateur'] : '',
                'title_navigateur' => $title_navigateur,
                'id_admin' => $id_admin
            ];

            $success = add_navigateur($data, $pdo);
            if ($success) {
                header('Location: /workshop_crti/admin_page/index.php?view=navigateur');
                exit;
            } else {
                $errors['database'] = "Error adding content to the database.";
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
        return [
            'temp_path' => $temp_path,
            'unique_name' => $unique_name,
            'upload_dir' => $upload_dir,
        ];
    } else {
        $errors[$field_name] = "Error uploading file.";
        return null;
    }
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
