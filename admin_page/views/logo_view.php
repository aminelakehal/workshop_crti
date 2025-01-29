
<?php
require_once __DIR__ . '/../controllers/logo_controller.php';
require_once __DIR__ . '/../layout/header.php';
?>

<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Liste des  logo:</h2>
    </div>

<!-- ========================== table logo =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">logo_home</th>
                        <th scope="col">logo right</th>
                        <th scope="col">logo left</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $logo_result = get_all_logo($pdo);
                $i = 1;
                foreach ($logo_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td><img src=\"" . htmlspecialchars($data['logo_home']) . "\" alt=\"About Image\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                    echo "<td><img src=\"" . htmlspecialchars($data['logo1']) . "\" alt=\"About Image\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                    echo "<td><img src=\"" . htmlspecialchars($data['logo2']) . "\" alt=\"About Image\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                    echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                    echo "<td>";
                    echo "<a href=\"index.php?view=logo&id_logo=" . $data['id_logo'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
        </tbody>
    </table>
</div>
</div>
<a href="index.php?view=add_logo" class="btn btn-success"> add logo</a>

<?php require_once __DIR__ . '/../layout/footer.php';?>