<?php
require_once __DIR__ . '/../form_controller.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field_names = $_POST['field_name'] ?? [];
    $field_types = $_POST['field_type'] ?? [];

    $inserted_count = 0;
    $error_count = 0;

    // Loop through submitted fields
    foreach ($field_names as $key => $form_field_name) {
        $form_field_name = trim($form_field_name);
        $field_type = trim($field_types[$key]);

        if (!empty($form_field_name) && !empty($field_type)) {
            $data = [
                'field_name' => htmlspecialchars($form_field_name), // Adjust to match your actual column name
                'field_type' => htmlspecialchars($field_type)
            ];
            if (add_form_fields($data, $pdo)) {
                $inserted_count++;
            } else {
                $error_count++;
            }
        } else {
            $error_count++;
        }
    }

    // Output result message
    $result = "$inserted_count champ(s) enregistré(s) avec succès!<br>";
    if ($error_count > 0) {
        $result .= "$error_count champ(s) ignoré(s) ou non insérés.<br>";
    }
    echo $result; // Output the result to the user
}
?>

