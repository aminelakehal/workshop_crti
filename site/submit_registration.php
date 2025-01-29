<?php

require_once __DIR__ . '/controllers/controller_division.php';
require_once __DIR__ . '/controllers/controllers_etablissement.php';
require_once __DIR__ . '/controllers/controller_secteur.php';
require_once __DIR__ . '/controllers/controller_form.php';

$errors = [];
$success = [];

$id_user = $_SESSION['id_user'] ?? null;
if ($id_user === null) {
    $_SESSION['error'] = "You don't have an account";
    header('Location: registration.php');
    exit;
}

$student_email = $_SESSION['email']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required_fields = ['etablissement', 'nom_div', 'nom_etablissement', 'nom_sect'];
    $input_data = [];

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            $errors[] = "The field $field is required.";
        } else {
            $input_data[$field] = htmlspecialchars(trim($_POST[$field]));
        }
    }

    $_SESSION['data'] = $input_data;

    if (empty($errors)) {
        $pattern = "/^[a-zA-Z0-9\s]+$/";
        $field_names = [
            'etablissement' => 'Etablissement',
            'nom_etablissement' => 'Nom Etablissement ',
            'nom_sect' => 'Secteur ',
            'nom_div' => 'Laboratoire/Division'
        ];
        foreach ($input_data as $key => $value) {
            if (!preg_match($pattern, $value)) {
                $field_name = $field_names[$key] ?? $key;
                $errors[] = "Invalid characters detected in the {$field_name} field. Please use only English letters, numbers, and spaces.";
            }
        }
    }

    if (empty($errors)) {
        $uploadDirectory = '../uploads_workshop/uploads_PDF_Condidats/' . $student_email . '/';
        $inserted_count = 0;
        $error_count = 0;
        $upload_errors = [];

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        if (isset($_FILES['files'])) {
            $id_file_fields = $_POST['id_file_fields']; 
            foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                $fileError = $_FILES['files']['error'][$key];
                if ($fileError === UPLOAD_ERR_OK) {
                    $fileName = basename($_FILES['files']['name'][$key]);
                    $targetFilePath = $uploadDirectory . $fileName;

                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    if (!in_array($fileType, ['pdf'])) {
                        $upload_errors[] = "Invalid file type for file $fileName. Only PDF files are allowed.";
                        continue;
                    }

                    if (!move_uploaded_file($tmpName, $targetFilePath)) {
                        $upload_errors[] = "Failed to upload file $fileName.";
                    }
                } else {
                    $upload_errors[] = "Error uploading file $fileName.";
                }
            }
        }

        if (!empty($upload_errors)) {
            $errors = array_merge($errors, $upload_errors);
        }
    }

    if (empty($errors)) {
        try {
            $etablissement_data = [
                'id_etablissement' => null,
                'nom_etablissement' => $input_data['nom_etablissement'],
                'etablissement' => $input_data['etablissement'],
                'id_user' => $id_user
            ];

            if (add_etablissement($etablissement_data, $pdo)) {
                $success[] = "Establishment successfully added.";
                $id_etablissement = $pdo->lastInsertId();

                if (isset($_FILES['files'])) {
                    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
                        $fileName = basename($_FILES['files']['name'][$key]);
                        $targetFilePath = $uploadDirectory . $fileName;
                        $id_file_fields = $_POST['id_file_fields'][$key];

                        $data = [
                            'file_name' => $fileName,
                            'file_path' => $targetFilePath,
                            'upload_date' => date('Y-m-d H:i:s'),
                            'id_etablissement' => $id_etablissement,
                            'id_file_fields' => $id_file_fields
                        ];

                        if (add_file_data($data, $pdo)) {
                            $inserted_count++;
                        } else {
                            $error_count++;
                        }
                    }
                }

                if ($inserted_count > 0) {
                    $success[] = "$inserted_count file(s) uploaded successfully!";
                }
                if ($error_count > 0) {
                    $errors[] = "$error_count error(s) occurred during file upload.";
                }

                $secteur_data = [
                    'id_secteur' => null,
                    'nom_sect' => $input_data['nom_sect'],
                    'id_etablissement' => $id_etablissement
                ];

                if (add_secteur($secteur_data, $pdo)) {
                    $success[] = "Sector successfully added.";
                } else {
                    $errors[] = "Failed to add sector.";
                }

                $division_data = [
                    'id_division' => null,
                    'nom_div' => $input_data['nom_div'],
                    'id_etablissement' => $id_etablissement
                ];

                if (add_division($division_data, $pdo)) {
                    $success[] = "Division successfully added.";
                } else {
                    $errors[] = "Failed to add division.";
                }
            } else {
                $errors[] = "Failed to add establishment.";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: form.php');
        exit;
    }
    if (!empty($success)) {
        $_SESSION['success'] = implode(' ', $success);
        unset($_SESSION['data']);
        header('Location: registration.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header('Location: registration.php');
    exit;
}
?>