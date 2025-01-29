
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session'); 
    session_start();
}

require_once __DIR__ . '/../controllers/controller_navigateur.php';

$isLoggedIn = isset($_SESSION['id_user']); 

$fullname = ''; 
if ($isLoggedIn && isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
    $fullname = htmlspecialchars($_SESSION['nom']) . ' ' . htmlspecialchars($_SESSION['prenom']);
}
?>

<?php
$navigateur = get_all_navigateur($pdo); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach ($navigateur as $item): ?>
    <title><?php echo htmlspecialchars($item['title_navigateur']); ?></title>
    <link rel="shortcut icon" href="<?php echo htmlspecialchars($item['image_navigateur']); ?>" type="image/x-icon">
    <?php endforeach; ?>
    <script src="layout//css/bootstrap/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="layout/css/style.css">
    <link rel="stylesheet" href="layout/css/bootstrap/icon-font.min.css">
    <link href="layout/css/bootstrap/bootstrap5.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="layout/css/bootstrap/bootstrap.min.css">
</head>

<?php
 require_once __DIR__ . '/../controllers/controller_color.php';
?>

<?php
$Color = get_all_color_site($pdo);

$textColor = "#504d4d";
$bgColor = "#5161ce";
$bgColorHover = "#3448c5";
$bgColorBody = "#f0f0f0";
$footerBackground = "#3448c5";
$h1Color = "#272727";
$h2Color = "#272727";
$h3Color = "#272727";
$h4Color = "#464646";
$h5Color = "#272727";
$h6Color = "#272727";


foreach ($Color as $item) {
    $textColor = htmlspecialchars($item['text_color']);
    $bgColor = htmlspecialchars($item['bg_color']);
    $bgColorHover = htmlspecialchars($item['bg_color_hover']);
    $bgColorBody = htmlspecialchars($item['bg_color_body']);
    $footerBackground = htmlspecialchars($item['footer_background']);
    $h1Color = htmlspecialchars($item['h1_color']);
    $h2Color = htmlspecialchars($item['h2_color']);
    $h3Color = htmlspecialchars($item['h3_color']);
    $h4Color = htmlspecialchars($item['h4_color']);
    $h5Color = htmlspecialchars($item['h5_color']);
    $h6Color = htmlspecialchars($item['h6_color']);
}
?>

<style>
   :root {
    --text-color: <?php echo $textColor; ?>; 
    --bg-color: <?php echo $bgColor; ?>; 
    --bg-color-hover: <?php echo $bgColorHover; ?>;
    --bg-color-body: <?php echo $bgColorBody; ?>;
    --footer-background: <?php echo $footerBackground; ?>;
    --h1-color: <?php echo $h1Color; ?>;
    --h2-color: <?php echo $h2Color; ?>;
    --h3-color: <?php echo $h3Color; ?>;
    --h4-color: <?php echo $h4Color; ?>;
    --h5-color: <?php echo $h5Color; ?>;
    --h6-color: <?php echo $h6Color; ?>;
}
</style>

