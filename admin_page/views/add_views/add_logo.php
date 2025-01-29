<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
    <h2 class="mb-4">Upload Logos</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="controllers/add/add_logo.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="logo_home" class="form-label">Logo Home:</label>
            <?php if (!empty($file_data['logo_home'])): ?>
                <div class="mb-2">
                    <img src="<?php echo htmlspecialchars($file_data['logo_home']); ?>" alt="Current Logo Home" class="img-thumbnail" width="100">
                </div>
            <?php endif; ?>
            <input type="file" name="logo_home" id="logo_home" class="form-control">
            <input type="hidden" name="current_logo_home" value="<?php echo htmlspecialchars($file_data['logo_home']); ?>">
        </div>

        <div class="mb-3">
            <label for="logo1" class="form-label">Logo right:</label>
            <?php if (!empty($file_data['logo1'])): ?>
                <div class="mb-2">
                    <img src="<?php echo htmlspecialchars($file_data['logo1']); ?>" alt="Current Logo 1" class="img-thumbnail" width="100">
                </div>
            <?php endif; ?>
            <input type="file" name="logo1" id="logo1" class="form-control">
            <input type="hidden" name="current_logo1" value="<?php echo htmlspecialchars($file_data['logo1']); ?>">
        </div>

        <div class="mb-3">
            <label for="logo2" class="form-label">Logo left:</label>
            <?php if (!empty($file_data['logo2'])): ?>
                <div class="mb-2">
                    <img src="<?php echo htmlspecialchars($file_data['logo2']); ?>" alt="Current Logo 2" class="img-thumbnail" width="100">
                </div>
            <?php endif; ?>
            <input type="file" name="logo2" id="logo2" class="form-control">
            <input type="hidden" name="current_logo2" value="<?php echo htmlspecialchars($file_data['logo2']); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php';?>