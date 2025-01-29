<?php
ob_start();
require_once __DIR__ . '/../controllers/delete.php';
require_once __DIR__ . '/../controllers/archive_controllers.php';



// Handle POST requests for archiving and truncating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['archive_db'])) {
        archiveDatabase();
    }
    if (isset($_POST['truncate_db'])) {
        truncateTables();
    }
}

// Include the header
require_once __DIR__ . '/../layout/header.php';
?>



<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . '</div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</div>';
    }
    unset($_SESSION['errors']);
}
?>









<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Admin List:</h2>
    </div>
    
    <div class="mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $admin_result = get_all_admin($pdo);
                $i = 1;
                foreach ($admin_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['prenom_admin']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nom_admin']) . "</td>"; 
                    echo "<td>" . htmlspecialchars($data['email_admin']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['Role']) . "</td>"; 
                    echo "<td>";
                    echo "<a href=\"index.php?view=edit_admin&id_edit_admin=" . $data['id_admin'] . "\" class=\"btn btn-primary\">Edit</a> | ";
                    echo "<a href=\"index.php?view=Admin&id_admin=" . $data['id_admin'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete this Admin?');\">Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <a href="index.php?view=add_admin" class="btn btn-success">Add a Admin</a>
        </div>
    </div>
</div>

<br><br><br>



<form method="POST" action="">
<button class="svg-save" type="submit" name="archive_db"></button>
</form>
<br><br>
<!-- Data Truncation Button -->
<form method="POST" action="">

    <button class="svg-delete" type="submit" name="truncate_db" onclick="return confirm('Have you backed up the data in the archive? Are you sure you want to delete the data?');"></button>
</form>
<br><br>
<?php 
require_once __DIR__ . '/../layout/footer.php';
ob_end_flush();
?>