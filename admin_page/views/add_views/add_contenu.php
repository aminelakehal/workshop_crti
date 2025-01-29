<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Add new content</h2>
        <form method="post" action="controllers/add/add_contenu.php" enctype="multipart/form-data" class="needs-validation" novalidate >
            <div class="mb-3">
                <label for="video_src" class="form-label">Intro video track :</label>
                <input type="file" name="video_src" id="video_src" class="form-control" required>
                <div class="invalid-feedback">
                    <?php echo $errors['video_src'] ?? 'Please choose a video file.'; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="download_link" class="form-label">PDF file for download:</label>
                <input type="file" name="download_link" id="download_link" class="form-control" required>
                <div class="invalid-feedback">
                    <?php echo $errors['download_link'] ?? 'Please choose a PDF file.'; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="about_image" class="form-label">Section image About:</label>
                <input type="file" name="about_image" id="about_image" class="form-control" required>
                <div class="invalid-feedback">
                    <?php echo $errors['about_image'] ?? 'Please choose an image file.'; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="workshop_title" class="form-label">Title About:</label>
                <input type="text" name="workshop_title" id="workshop_title" class="form-control" value="<?php echo htmlspecialchars($_POST['workshop_title'] ?? ''); ?>" required>
                <div class="invalid-feedback">
                    <?php echo $errors['workshop_title'] ?? 'Please enter a workshop title.'; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="workshop_description1" class="form-label">Workshop Description 1:</label>
                <textarea name="workshop_description1" id="workshop_description1" rows="5" class="form-control" required><?php echo htmlspecialchars($_POST['workshop_description1'] ?? ''); ?></textarea>
                <div class="invalid-feedback">
                    <?php echo $errors['workshop_description1'] ?? 'Please enter the first workshop description.'; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="workshop_description2" class="form-label">Workshop Description 2:</label>
                <textarea name="workshop_description2" id="workshop_description2" rows="5" class="form-control" required><?php echo htmlspecialchars($_POST['workshop_description2'] ?? ''); ?></textarea>
                <div class="invalid-feedback">
                    <?php echo $errors['workshop_description2'] ?? 'Please enter the second workshop description.'; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Addition</button>
        </form>
    </div>
    <?php
require_once __DIR__ . '/../../layout/footer.php';
?>