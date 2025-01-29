<?php 
include './layout/sidbar_registration.php'; 
require_once __DIR__ . '/controllers/social_media_controller.php'; 
require_once __DIR__ . '/controllers/controller_form.php';
?>

<style>
    .mt-5, .my-5 {
        margin-top: 8rem !important;
    }

    .form {
        padding: 10px;
        max-width: 800px;
        width: 100%;
        background: #d1d5f0;
        padding: 20px;
        box-sizing: border-box;
        margin: 0 auto;
        padding-top: 50px;
        margin-top: 50px;
    }

    @media (max-width: 599px) {
        .form {
            padding-left: 20px;
            padding-right: 20px;
        }
    }
    .alert {
        display: none; 
    }
</style>

<center>
<h2 class="text-center mt-5">Registration Form</h2>
    <div class="form">
    <?php 
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); 
    }
    ?>
        <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p id="error-message" ><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form action="submit_registration.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="etablissement">Etablissement <span class="text-danger">*</span></label>
                <select class="form-control" id="etablissement" name="etablissement" required>
                    <option value="" disabled selected>Select etablissement</option>
                    <option value="University" <?php echo (isset($_SESSION['data']['etablissement']) && $_SESSION['data']['etablissement'] == 'University') ? 'selected' : ''; ?>>University</option>
                    <option value="Institute" <?php echo (isset($_SESSION['data']['etablissement']) && $_SESSION['data']['etablissement'] == 'Institute') ? 'selected' : ''; ?>>Institute</option>
                    <option value="Startup" <?php echo (isset($_SESSION['data']['etablissement']) && $_SESSION['data']['etablissement'] == 'Startup') ? 'selected' : ''; ?>>Startup</option>
                    <option value="other" <?php echo (isset($_SESSION['data']['etablissement']) && $_SESSION['data']['etablissement'] == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nom_etablissement">Name Establishment <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nom_etablissement" name="nom_etablissement" placeholder="Nom Etablissement" 
                value="<?php echo isset($_SESSION['data']['nom_etablissement']) ? htmlspecialchars($_SESSION['data']['nom_etablissement']) : ''; ?>" required />
            </div>

            <div class="form-group">
                <label for="nom_sect">Secteur <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nom_sect" name="nom_sect" placeholder="Nom Secteur"
                value="<?php echo isset($_SESSION['data']['nom_sect']) ? htmlspecialchars($_SESSION['data']['nom_sect']) : ''; ?>" required />
            </div>

            <div class="form-group">
                <label for="nom_div">Laboratoire/Division <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nom_div" name="nom_div" placeholder="Division" 
                value="<?php echo isset($_SESSION['data']['nom_div']) ? htmlspecialchars($_SESSION['data']['nom_div']) : ''; ?>" required />
            </div>

            <?php
                $form_fields = get_all_file_fields($pdo);
            ?>

            <?php foreach ($form_fields as $index => $row): ?>
                <div class="form-group">
                    <label><?php echo htmlspecialchars($row["field_name"]); ?> <span class="text-danger">*</span></label>
                    <input type="file" name="files[]" class="form-control" required>
                    <input type="hidden" name="id_file_fields[]" value="<?php echo htmlspecialchars($row['id_file_fields']); ?>">
                </div>
            <?php endforeach; ?>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Soumettre</button>
            </div>
        </form>
    </div>
</center>


<script>
$(document).ready(function() {
    const errorMessages = $('.error-message');
    const alertDanger = $('.alert.alert-danger');
    const alertSuccess = $('.alert.alert-success');

    if (alertDanger.length) {
        alertDanger.fadeIn(300);
        setTimeout(() => {
            alertDanger.fadeOut(300, function() {
                $(this).remove(); 
            });
        }, 3000); 
    }

    if (alertSuccess.length) {
        alertSuccess.fadeIn(500);
        setTimeout(() => {
            alertSuccess.fadeOut(300, function() {
                $(this).remove(); 
            });
        }, 2000); 
    }
});
</script>
    


<?php 
unset($_SESSION['errors']);
unset($_SESSION['data']);
include './layout/footer.php'; 
?>