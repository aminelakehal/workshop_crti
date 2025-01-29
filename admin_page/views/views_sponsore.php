<?php
require_once __DIR__ . '/../controllers/sponsore_controller.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Liste des sponsors :</h2>
    </div>

<div class="mt-5">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sponsor</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sponsore_result = get_all_sponsore($pdo);
                $i = 1;
                foreach ($sponsore_result as $data) {
                    $imageUrl = htmlspecialchars($data['URL_imag_spon']);
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td><img src=\"" . $imageUrl . "\" alt=\"Image\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                    echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                    echo "<td>";
                    echo "<a href=\"index.php?view=sponsore&id_sponsore=" . $data['id_sponsore'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php?view=add_sponsore" class="btn btn-success mt-3">add sponsor</a>
    </div>
</div>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>
