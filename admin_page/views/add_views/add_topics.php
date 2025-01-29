<?php
require_once __DIR__ . '/../../layout/header.php';
?>


<div class="container mt-5">
    <div class="titre mb-4">
    <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success mt-3"><?php echo htmlspecialchars($_SESSION['success']); ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <h2>Add topics</h2>
        <form action="controllers/add/add_topics.php" method="POST">
            <div class="form-group">
                <label for="design_sujet">Topics (Separate multiple topics with periods):</label>
                <textarea class="form-control" id="design_sujet" name="design_sujet" rows="5" required><?php echo isset($_SESSION['data']['design_sujet']) ? htmlspecialchars($_SESSION['data']['design_sujet']) : ''; ?></textarea>
                <?php if (isset($_SESSION['errors']['design_sujet'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['errors']['design_sujet']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Add Topics</button>
            <a href="index.php?view=topic" class="btn btn-secondary">Cancel</a>
        </form>
        
      
    </div>

    <?php
    unset($_SESSION['errors']);
    unset($_SESSION['data']);
    require_once __DIR__ . '/../../layout/footer.php';
    ?>
