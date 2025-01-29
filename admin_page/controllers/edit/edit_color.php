<?php
require_once __DIR__ . '/../controller_color.php';
if (!isset($_GET['id_edit_color'])) {
    echo "Invalid request.";
    exit;
}

$id_color = intval($_GET['id_edit_color']);

$color_data = get_color_site($id_color, $pdo);

if (!$color_data) {
    echo "Color not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textColor = htmlspecialchars($_POST['text_color']);
    $bgColor = htmlspecialchars($_POST['bg_color']);
    $bgColorHover = htmlspecialchars($_POST['bg_color_hover']);
    $bgColorBody = htmlspecialchars($_POST['bg_color_body']);
    $footerBackground = htmlspecialchars($_POST['footer_background']);
    $h1Color = htmlspecialchars($_POST['h1_color']);
    $h2Color = htmlspecialchars($_POST['h2_color']);
    $h3Color = htmlspecialchars($_POST['h3_color']);
    $h4Color = htmlspecialchars($_POST['h4_color']);
    $h5Color = htmlspecialchars($_POST['h5_color']);
    $h6Color = htmlspecialchars($_POST['h6_color']);

    $update_data = [
        'text_color' => $textColor,
        'bg_color' => $bgColor,
        'bg_color_hover' => $bgColorHover,
        'bg_color_body' => $bgColorBody,
        'footer_background' => $footerBackground,
        'h1_color' => $h1Color,
        'h2_color' => $h2Color,
        'h3_color' => $h3Color,
        'h4_color' => $h4Color,
        'h5_color' => $h5Color,
        'h6_color' => $h6Color,
    ];

    if (update_color_site($update_data, $id_color, $pdo)) {
        header('Location: /workshop_crti/admin_page/index.php?view=color');
        exit;
    } else {
        echo "An error occurred while updating the color settings.";
    }
}


?>