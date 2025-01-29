<?php

require_once __DIR__ . '/../controller_contenu.php';
$errors = []; 
$file_data = [
    'video_src' => '',
    'download_link' => '',
    'about_image' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $upload_dir_images = __DIR__ . '/../../../uploads_workshop/uploads_content/images/';
    $upload_dir_videos = __DIR__ . '/../../../uploads_workshop/uploads_content/videos/';
    $upload_dir_pdfs = __DIR__ . '/../../../uploads_workshop/uploads_content/pdfs/';
    
    // Create directories if they don't exist
    foreach ([$upload_dir_images, $upload_dir_videos, $upload_dir_pdfs] as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    // Sanitize and validate input
    $workshop_title = filter_input(INPUT_POST, 'workshop_title', FILTER_SANITIZE_STRING);
    $workshop_description1 = filter_input(INPUT_POST, 'workshop_description1', FILTER_SANITIZE_STRING);
    $workshop_description2 = filter_input(INPUT_POST, 'workshop_description2', FILTER_SANITIZE_STRING);

    if (empty($workshop_title)) {
        $errors['workshop_title'] = "Workshop title is required.";
    }
    if (empty($workshop_description1)) {
        $errors['workshop_description1'] = "Workshop Description 1 is required.";
    }
    if (empty($workshop_description2)) {
        $errors['workshop_description2'] = "Workshop Description 2 is required.";
    }

    $temp_files = [];

    // Process file uploads
    $file_fields = [
        'about_image' => ['dir' => $upload_dir_images, 'types' => ['image/jpeg', 'image/png', 'image/gif'], 'max_size' => 5 * 1024 * 1024],
        'download_link' => ['dir' => $upload_dir_pdfs, 'types' => ['application/pdf'], 'max_size' => 10 * 1024 * 1024],
        'video_src' => ['dir' => $upload_dir_videos, 'types' => ['video/mp4', 'video/avi', 'video/mov'], 'max_size' => 50 * 1024 * 1024]
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
                'video_src' => $file_data['video_src'] ? '/workshop_crti/uploads_workshop/uploads_content/videos/' . $file_data['video_src'] : '',
                'download_link' => $file_data['download_link'] ? '/workshop_crti/uploads_workshop/uploads_content/pdfs/' . $file_data['download_link'] : '',
                'about_image' => $file_data['about_image'] ? '/workshop_crti/uploads_workshop/uploads_content/images/' . $file_data['about_image'] : '',
                'workshop_title' => $workshop_title,
                'workshop_description1' => $workshop_description1,
                'workshop_description2' => $workshop_description2,
                'id_admin' => $id_admin
            ];

            $success = add_contenu($data, $pdo);
            if ($success) {
                header('Location: /workshop_crti/admin_page/index.php?view=contenu');
                exit;
            } else {
                $errors['database'] = "Error adding contenu to the database.";
            }
        }
    }

    // Clean up temporary files if there were errors
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