
<?php

if (!isset($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['Role'] == 'super_admin') {
    $fullName = htmlspecialchars($_SESSION['name_admin'] . ' ' . $_SESSION['surname_admin']);
    
} else {
    $fullName = htmlspecialchars($_SESSION['nom_admin'] . ' ' . $_SESSION['prenom_admin']);
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRTI | Dashboard</title>
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="ressource/img/svg/logo.svg" type="image/x-icon"> -->
    <!-- Custom styles -->
    <link rel="stylesheet" type="text/css" href="ressource/boostrap/all.min.css"> 
    <script src="ressource/js/chart.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="ressource/boostrap/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="ressource/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<div class="layer"></div>

<?php require_once __DIR__ . '/../layout/sidebar.php';?>

