<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Sign In</title>
  <link rel="shortcut icon" href="ressource/img/svg/logo.svg" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="ressource/css/style.css">

  <style>
      .error-message {
          color: #ff0000; 
          background-color: #f8d7da; 
          border: 1px solid #f5c6cb; 
          border-radius: 4px; 
          padding: 10px; 
          margin-top: 5px; 
          font-size: 14px; 
      }
  </style>
</head>
<?php
require_once __DIR__ . '/../logine/signin.php';
?>

<body>
  <div class="layer"></div>
  <main class="page-center">
    <article class="sign-up">
      <h1 class="sign-up__title">Welcome back!</h1>
      <p class="sign-up__subtitle">Sign in to your account to continue</p>
      <form class="sign-up-form form" action="" method="POST">
        <label class="form-label-wrapper">
          <p class="form-label">Email</p>
          <input class="form-input" type="email" name="email_admin" placeholder="Enter your email" required>
          <?php
          if (isset($_SESSION['email_error'])) {
            echo '<div class="error-message">' . $_SESSION['email_error'] . '</div>';
            unset($_SESSION['email_error']);
          }
          ?>
        </label>

        <label class="form-label-wrapper">
          <p class="form-label">Password</p>
          <input class="form-input" type="password" name="mot_passe_admin" placeholder="Enter your password" required>
          <?php
          if (isset($_SESSION['password_error'])) {
            echo '<div class="error-message">' . $_SESSION['password_error'] . '</div>';
            unset($_SESSION['password_error']);
          }
          ?>
        </label>

        <?php if (isset($errors['general'])) : ?>
          <p class="error-message"><?php echo $errors['general']; ?></p>
        <?php endif; ?>
        
        <br><br>
        <button class="form-btn primary-default-btn transparent-btn">Sign in</button>
      </form>
    </article>
  </main>
  <script src="./plugins/chart.min.js"></script>
  <script src="plugins/feather.min.js"></script>
  <script src="js/script.js"></script>
</body>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const errorMessages = document.querySelectorAll('.error-message');
    
    errorMessages.forEach(message => {
      setTimeout(() => {
        message.remove();
      }, 1000); 
    });
  });
</script>

</html>
