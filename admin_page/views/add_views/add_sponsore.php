<?php
require_once __DIR__ . '/../../layout/header.php';
?>

<div class="main-wrapper">
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Add a new sponsor:</h2>
    </div>

    <form method="POST" action="controllers/add/add_sponsore.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="URL_imag_spon">Image:</label>
            <input type="file" class="form-control" id="URL_imag_spon" name="URL_imag_spon[]" multiple required>
            </div>
       
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

<?php
require_once __DIR__ . '/../../layout/footer.php';
?>
