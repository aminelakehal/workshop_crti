<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
    <h2>Add a admin</h2>
    <form action="controllers/add/add_admin.php" method="POST">
        <div class="form-group">
            <label for="prenom_admin">First Name</label>
            <input type="text" class="form-control" id="prenom_admin" name="prenom_admin" value="<?php echo isset($_SESSION['data']['prenom_admin']) ? htmlspecialchars($_SESSION['data']['prenom_admin']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['prenom_admin'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['prenom_admin']); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="nom_admin">Last Name</label>
            <input type="text" class="form-control" id="nom_admin" name="nom_admin" value="<?php echo isset($_SESSION['data']['nom_admin']) ? htmlspecialchars($_SESSION['data']['nom_admin']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['nom_admin'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['nom_admin']); ?></div>
            <?php endif; ?>
        </div>


        <div class="form-group">
             <label for="email_admin">Email</label>
             <input type="email" class="form-control" id="email_admin" name="email_admin" value="<?php echo isset($_SESSION['data']['email_admin']) ? htmlspecialchars($_SESSION['data']['email_admin']) : ''; ?>" required>
             <?php if (isset($_SESSION['errors']['email_admin'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['email_admin']); ?></div>
             <?php endif; ?>
        </div>


        <div class="form-group">
            <label for="mot_passe_admin">Password</label>
            <input type="password" class="form-control" id="mot_passe_admin" name="mot_passe_admin" value="<?php echo isset($_SESSION['data']['mot_passe_admin']) ? htmlspecialchars($_SESSION['data']['mot_passe_admin']) : ''; ?>" required>
            <?php if (isset($_SESSION['errors']['mot_passe_admin'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['mot_passe_admin']); ?></div>
            <?php endif; ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php?view=Admin" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';
?>
