<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
    <h2>Add a new color</h2>
    <form action="controllers/add/add_color.php" method="POST">
        <div class="mb-3">
            <label for="text_color" class="form-label">Text Color:</label>
            <input type="color" class="form-control form-control-color" id="text_color" name="text_color" value="#504d4d" required>
        </div>

        <div class="mb-3">
            <label for="bg_color" class="form-label">Background Color:</label>
            <input type="color" class="form-control form-control-color" id="bg_color" name="bg_color" value="#5161ce" required>
        </div>

        <div class="mb-3">
            <label for="bg_color_hover" class="form-label">Background Color Hover:</label>
            <input type="color" class="form-control form-control-color" id="bg_color_hover" name="bg_color_hover" value="#3448c5" required>
        </div>

        <div class="mb-3">
            <label for="bg_color_body" class="form-label">Background Color Body:</label>
            <input type="color" class="form-control form-control-color" id="bg_color_body" name="bg_color_body" value="#f0f0f0" required>
        </div>

        <div class="mb-3">
            <label for="footer_background" class="form-label">Footer Background:</label>
            <input type="color" class="form-control form-control-color" id="footer_background" name="footer_background" value="#3448c5" required>
        </div>

        <div class="mb-3">
            <label for="h1_color" class="form-label">Color title:</label>
            <input type="color" class="form-control form-control-color" id="h1_color" name="h1_color" value="#272727" required>
        </div>

        <div class="mb-3">
            <label for="h2_color" class="form-label">H2 Color:</label>
            <input type="color" class="form-control form-control-color" id="h2_color" name="h2_color" value="#272727" required>
        </div>

        <div class="mb-3">
            <label for="h3_color" class="form-label">H3 Color:</label>
            <input type="color" class="form-control form-control-color" id="h3_color" name="h3_color" value="#272727" required>
        </div>

        <div class="mb-3">
            <label for="h4_color" class="form-label">Color title workshop:</label>
            <input type="color" class="form-control form-control-color" id="h4_color" name="h4_color" value="#464646" required>
        </div>

        <div class="mb-3">
            <label for="h5_color" class="form-label">H5 Color:</label>
            <input type="color" class="form-control form-control-color" id="h5_color" name="h5_color" value="#272727" required>
        </div>

        <div class="mb-3">
            <label for="h6_color" class="form-label">Color text content:</label>
            <input type="color" class="form-control form-control-color" id="h6_color" name="h6_color" value="#272727" required>
        </div>

        <button type="submit" class="btn btn-primary">add Couleur</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../../layout/footer.php';
?>