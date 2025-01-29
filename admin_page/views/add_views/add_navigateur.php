<?php
require_once __DIR__ . '/../../layout/header.php';
?>

    <div class="container mt-5">
   <div class="titre mb-4">
        <h1>Add new Workshop</h1>
        <form method="post" action="controllers/add/add_navigateur.php" enctype="multipart/form-data" class="needs-validation" novalidate >
          
        <div class="mb-3">
            <label for="image_navigateur" class="form-label">Image Navigateur:</label>
            <input type="file" name="image_navigateur" id="image_navigateur" class="form-control" required>
            <div class="invalid-feedback">
                <?php echo $errors['image_navigateur'] ?? 'Please choose an image.'; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="title_navigateur" class="form-label">Title Site:</label>
            <input type="text" name="title_navigateur" id="title_navigateur" class="form-control" value="<?php echo htmlspecialchars($_POST['title_navigateur'] ?? ''); ?>" required>
            <div class="invalid-feedback">
                <?php echo $errors['title_navigateur'] ?? 'Please enter a workshop title.'; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Addition</button>
    </form>

    </div>
    <?php
require_once __DIR__ . '/../../layout/footer.php';
?>