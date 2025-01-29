<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container">
<div class="container mt-5">
    <h2 class="Organisationnelle" >Ajouter une Organisationnelle</h2>

    <!-- Navigation Buttons -->
    <div class="btn-group mb-3">
        <button type="button" class="btn btn-secondary" onclick="showForm('formMembres')">Membres Organisationnelle</button>
        <button type="button" class="btn btn-secondary" onclick="showForm('formPresident')">Président Organisationnelle</button>
        <button type="button" class="btn btn-secondary" onclick="showForm('formVicePresident')">Vice-président Organisationnelle</button>
    </div>

    <!-- Form Membres Organisationnelle -->
    <div id="formMembres" class="form-container">
        <form action="controllers/add/add_organisationnelle/add_membres.php" method="POST">
            <div class="form-group">
                <label for="membres_O">Membres Organisationnelle</label>
                <input type="text" class="form-control" id="membres_O" name="membres_O" value="<?php echo isset($_SESSION['data']['membres_O']) ? htmlspecialchars($_SESSION['data']['membres_O']) : ''; ?>" required>
                <?php if (isset($_SESSION['errors']['membres_O'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['membres_O']); ?></div>
                <?php endif; ?>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php?view=user" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <!-- Form Président Organisationnelle -->
    <div id="formPresident" class="form-container" style="display:none;">
        <form action="controllers/add/add_organisationnelle/add_president.php" method="POST">
            <div class="form-group">
                <label for="president_O">Président Organisationnelle</label>
                <input type="text" class="form-control" id="president_O" name="president_O" value="<?php echo isset($_SESSION['data']['president_O']) ? htmlspecialchars($_SESSION['data']['president_O']) : ''; ?>" required>
                <?php if (isset($_SESSION['errors']['president_O'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['president_O']); ?></div>
                <?php endif; ?>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php?view=user" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <!-- Form Vice-président Organisationnelle -->
    <div id="formVicePresident" class="form-container" style="display:none;">
        <form action="controllers/add/add_organisationnelle/add_vice_president_O.php" method="POST">
            <div class="form-group">
                <label for="vice_president_O">Vice-président Organisationnelle</label>
                <input type="text" class="form-control" id="vice_president_O" name="vice_president_O" value="<?php echo isset($_SESSION['data']['vice_president_O']) ? htmlspecialchars($_SESSION['data']['vice_president_O']) : ''; ?>" required>
                <?php if (isset($_SESSION['errors']['vice_president_O'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['vice_president_O']); ?></div>
                <?php endif; ?>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php?view=user" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
</div>
<script>
    function showForm(formId) {
        document.getElementById('formMembres').style.display = 'none';
        document.getElementById('formPresident').style.display = 'none';
        document.getElementById('formVicePresident').style.display = 'none';
        document.getElementById(formId).style.display = 'block';
    }
</script>
<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';
?>
