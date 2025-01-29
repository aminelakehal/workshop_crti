<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session'); 
    session_start();
}


if (isset($_SESSION['id_user'])) {
    header('Location: ../index.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="erreurs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login In</title>
</head>





<?php
 require_once __DIR__ . '/../controllers/controller_color.php';
?>

<?php
$Color = get_all_color_site($pdo);


$bgColor = "#5161ce";
$bgColorHover = "#3448c5";



foreach ($Color as $item) {
    $textColor = htmlspecialchars($item['text_color']);
    $bgColor = htmlspecialchars($item['bg_color']);
    $bgColorHover = htmlspecialchars($item['bg_color_hover']);
   
}
?>

<style>
   :root {
    --bg-color: <?php echo $bgColor; ?>; 
    --bg-color-hover: <?php echo $bgColorHover; ?>;
 

}
</style>



<body>
    <div class="container">
        <div class="login">
            <form action="login_handler.php" method="POST">
                <h1>Login In</h1>
             
<br>
                <label>Email</label>
        <input type="email" name="email" placeholder="Email" 
            value="<?php echo isset($_SESSION['data']['email']) ? htmlspecialchars($_SESSION['data']['email']) : ''; ?>" required />
        <?php if (isset($_SESSION['errors']['email'])): ?>
            <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['email']; ?></p>
        <?php endif; ?>

        <label>Password</label>
        <input type="password" name="mot_de_passe" placeholder="Password" required />
        <?php if (isset($_SESSION['errors']['mot_de_passe'])): ?>
            <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['mot_de_passe']; ?></p>
        <?php endif; ?>
        <br>
        
                <button type="submit"><span>Submit</span></button>
                
                <p><a href="send_code.php">Mot de passe oublié ?</a></p>
                <br>
                <center>
                <a href="./register.php"><div class="svg-icon"></div></a>
                </center>
                
                <br>
                
                
            </form>
        </div>
        <div class="pic">
            <img src="img/Login In.png" alt="Image de connexion" />
        </div>
    </div>
</body>
<script>
function hideMessages() {
	const errorMessages = document.querySelectorAll('#error-message');
	

	errorMessages.forEach((message) => {
		setTimeout(() => {
			message.style.display = 'none';
		}, 1000); 
	});

	
}
window.onload = hideMessages;
</script>

</html>


<?php
// Clear session data after displaying
unset($_SESSION['errors']);
unset($_SESSION['data']);
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
    unset($_SESSION);
}
?>

