<?php
require_once __DIR__ . '/../controllers_theme.php';

$errors = [];
$input = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input['title_home'] = filter_input(INPUT_POST, 'title_home', FILTER_SANITIZE_STRING);
    $input['presedant_workshop'] = filter_input(INPUT_POST, 'presedant_workshop', FILTER_SANITIZE_STRING);
    $input['description'] = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $input['paper_submission_date'] = filter_input(INPUT_POST, 'paper_submission_date', FILTER_SANITIZE_STRING);
    $input['acceptance_notification_date'] = filter_input(INPUT_POST, 'acceptance_notification_date', FILTER_SANITIZE_STRING);
    $input['workshop_dates'] = filter_input(INPUT_POST, 'workshop_dates', FILTER_SANITIZE_STRING);
    $input['registration_fee'] = filter_input(INPUT_POST, 'registration_fee', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input['additional_info'] = filter_input(INPUT_POST, 'additional_info', FILTER_SANITIZE_STRING);

    if (empty($input['title_home'])) {
        $errors['title_home'] = "Title home workshop is required.";
    }

    if (empty($input['presedant_workshop'])) {
        $errors['presedant_workshop'] = "Presedant workshop is required.";
    }

    if (empty($input['description'])) {
        $errors['description'] = "Description is required.";
    }

    if (empty($input['paper_submission_date'])) {
        $errors['paper_submission_date'] = "Paper submission date is required.";
    }

    if (empty($input['acceptance_notification_date'])) {
        $errors['acceptance_notification_date'] = "Acceptance notification date is required.";
    }

    if (empty($input['workshop_dates'])) {
        $errors['workshop_dates'] = "Workshop dates are required.";
    }

    if (empty($input['additional_info'])) {
        $errors['additional_info'] = "Additional info is required.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['input'] = $input;

        header('Location: /workshop_crti/admin_page/index.php?view=add_theme_view');
        exit;
    } else {
        $id_admin = ($_SESSION['Role'] === 'super_admin') ? null : intval($_SESSION['id_admin']);

        $data = [
            'title_home' => $input['title_home'],
            'presedant_workshop' => $input['presedant_workshop'],
            'description' => $input['description'],
            'paper_submission_date' => $input['paper_submission_date'],
            'acceptance_notification_date' => $input['acceptance_notification_date'],
            'workshop_dates' => $input['workshop_dates'],
            'registration_fee' => $input['registration_fee'],
            'additional_info' => $input['additional_info'],
            'id_admin' => $id_admin
        ];

        if (add_theme($data, $pdo)) {
            $_SESSION['success'] = "The theme was added successfully.";
            header('Location: /workshop_crti/admin_page/index.php?view=add_theme_view');
            exit;
        } else {
            echo "<div class='message'>Error inserting theme.</div>";
        }
    }
}
?>