<?php
require_once __DIR__ . '/../controllers/controller_navigateur.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Liste des title_navigateur :</h2>
    </div>

    <!-- ========================== table navigateur =============================== -->

    <div class="mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title Navigateur</th>
                        <th scope="col">Image Navigateur</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $workshop_title = get_all_navigateur($pdo);
                    $i = 1;
                    foreach ($workshop_title as $data) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $i++ . "</th>";
                        echo "<td>" . htmlspecialchars($data['title_navigateur']) . "</td>";
                        echo "<td><img src=\"" . htmlspecialchars($data['image_navigateur']) . "\" alt=\"Navigateur Image\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                        echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                        echo "<td>";
                        echo "<a href=\"index.php?view=navigateur&id_navigateur=" . htmlspecialchars($data['id_navigateur']) . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="index.php?view=add_navigateur" class="btn btn-success">add title navigateur</a>
</div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
