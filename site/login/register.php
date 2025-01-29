<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('user_session');
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/../controllers/controller_color.php';
$Color = get_all_color_site($pdo);

$bgColor = "#5161ce";
$bgColorHover = "#3448c5";

foreach ($Color as $item) {
    $textColor = htmlspecialchars($item['text_color']);
    $bgColor = htmlspecialchars($item['bg_color']);
    $bgColorHover = htmlspecialchars($item['bg_color_hover']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="erreurs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
       :root {
            --bg-color: <?php echo $bgColor; ?>; 
            --bg-color-hover: <?php echo $bgColorHover; ?>;
        }
    </style>
</head>
<body>
    <span style="font-family: verdana, geneva, sans-serif;">
        <div class="container">
            <div class="login">
                <form action="register_handler.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                    <h1>Sign up</h1>

                    <?php if (isset($_SESSION['success'])): ?>
                        <p id="success-message" class="form-success"><?php echo $_SESSION['success']; ?></p>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <label>First Name</label>
                    <input type="text" name="prenom" placeholder="Enter your first name" 
                        value="<?php echo isset($_SESSION['data']['prenom']) ? htmlspecialchars($_SESSION['data']['prenom']) : ''; ?>" required>
                    <?php if (isset($_SESSION['errors']['prenom'])): ?>
                        <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['prenom']; ?></p>
                    <?php endif; ?>

                    <label>Last Name</label>
                    <input type="text" name="nom" placeholder="Enter your last name" 
                        value="<?php echo isset($_SESSION['data']['nom']) ? htmlspecialchars($_SESSION['data']['nom']) : ''; ?>" required>
                    <?php if (isset($_SESSION['errors']['nom'])): ?>
                        <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['nom']; ?></p>
                    <?php endif; ?>

                    <label>Phone Number</label>
                    <input type="tel" name="numero_telephone" placeholder="Enter your phone number" 
                        pattern="^(05|06|07|02)[0-9]{8}$" 
                        value="<?php echo isset($_SESSION['data']['numero_telephone']) ? htmlspecialchars($_SESSION['data']['numero_telephone']) : ''; ?>" required>
                    <?php if (isset($_SESSION['errors']['numero_telephone'])): ?>
                        <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['numero_telephone']; ?></p>
                    <?php endif; ?>

                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" 
                        value="<?php echo isset($_SESSION['data']['email']) ? htmlspecialchars($_SESSION['data']['email']) : ''; ?>" required>
                    <?php if (isset($_SESSION['errors']['email'])): ?>
                        <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['email']; ?></p>
                    <?php endif; ?>

                    <label>Password</label>
                    <input type="password" name="mot_de_passe" placeholder="Enter your password" required>
                    <?php if (isset($_SESSION['errors']['mot_de_passe'])): ?>
                        <p id="error-message" class="form-error"><?php echo $_SESSION['errors']['mot_de_passe']; ?></p>
                    <?php endif; ?>

                    <button type="submit"><span>Submit</span></button>
                    <br>
                    <center>
                        <a href="./login.php"><div class="svg-icon"></div></a>
                    </center>    
                </form>
                <?php
                    unset($_SESSION['errors']);
                    unset($_SESSION['data']);
                ?>
            </div>
            <div class="pic">
                <img src="./img/Sign up.png" />
            </div>

          
        </div>
    </span>
</body>

<script>
function hideMessages() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 1000); 
    }

    const errorMessages = document.querySelectorAll('.form-error');
    errorMessages.forEach((message) => {
        setTimeout(() => {
            message.style.display = 'none';
        }, 1000); 
    });
}

window.onload = hideMessages;
</script>

</html>
