
<?php require_once __DIR__ . '/../../controllers/edit/edit_color.php';?>
<?php require_once __DIR__ . '/../../layout/header.php';?>


<style>

 .form-control {
    border-radius: 18.25rem;
    padding: -10.5rem 0.75rem;
}

.form-control {
    display: block;
    width: 7%;
    padding: -0.625rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--bs-body-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: var(--bs-body-bg);
    background-clip: padding-box;
    border: var(--bs-border-width) solid var(--bs-border-color);
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>

<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Edit Color Settings</h2>
    </div>
    <form method="post">
        <div class="form-group">
            <label for="text_color">Text Color</label>
            <input type="color" id="text_color" name="text_color" value="<?php echo htmlspecialchars($color_data['text_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="bg_color">Background Color</label>
            <input type="color" id="bg_color" name="bg_color" value="<?php echo htmlspecialchars($color_data['bg_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="bg_color_hover">Hover Background Color</label>
            <input type="color" id="bg_color_hover" name="bg_color_hover" value="<?php echo htmlspecialchars($color_data['bg_color_hover'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="bg_color_body">Body Background Color</label>
            <input type="color" id="bg_color_body" name="bg_color_body" value="<?php echo htmlspecialchars($color_data['bg_color_body'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="footer_background">Footer Background Color</label>
            <input type="color" id="footer_background" name="footer_background" value="<?php echo htmlspecialchars($color_data['footer_background'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="h1_color">H1 Color</label>
            <input type="color" id="h1_color" name="h1_color" value="<?php echo htmlspecialchars($color_data['h1_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="h2_color">H2 Color</label>
            <input type="color" id="h2_color" name="h2_color" value="<?php echo htmlspecialchars($color_data['h2_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="h3_color">H3 Color</label>
            <input type="color" id="h3_color" name="h3_color" value="<?php echo htmlspecialchars($color_data['h3_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="h4_color">H4 Color</label>
            <input type="color" id="h4_color" name="h4_color" value="<?php echo htmlspecialchars($color_data['h4_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="h5_color">H5 Color</label>
            <input type="color" id="h5_color" name="h5_color" value="<?php echo htmlspecialchars($color_data['h5_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="h6_color">H6 Color</label>
            <input type="color" id="h6_color" name="h6_color" value="<?php echo htmlspecialchars($color_data['h6_color'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update Colors</button>
    </form>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>