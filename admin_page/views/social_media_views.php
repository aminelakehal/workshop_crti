<?php
require_once __DIR__ . '/../controllers/social_media_controlles.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Liste des réseaux sociaux :</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">YouTube</th>
                    <th scope="col">Twitter</th>
                    <th scope="col">Facebook</th>
                    <th scope="col">Email CRTI</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $social_media_result = get_all_social_media($pdo);
                $i = 1;
                foreach ($social_media_result as $row) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($row['Youtube']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['twitter']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['facebook']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email_crti']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['admin_name']) . "</td>";
                    echo "<td>";
                    echo "<a href=\"index.php?view=social_media&id_RS=" . htmlspecialchars($row['id_RS']) . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
            </tbody>
        </table>
        <a href="index.php?view=add_social_media" class="btn btn-success mb-3">add réseau social</a>
    </div>
</div>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>
