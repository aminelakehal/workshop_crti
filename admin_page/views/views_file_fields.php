<?php
require_once __DIR__ . '/../controllers/controller_fields.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Liste des  input file:</h2>
    </div>

<!-- ========================== table president =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">field name</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $file_fields = get_all_file_fields($pdo);
                $i = 1;
                foreach ($file_fields as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['field_name']) . "</td>";
                    echo "<td>";
                    echo "<a href=\"index.php?view=fields&id_file_fields=" . $data['id_file_fields'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
        </tbody>
    </table>
</div>
</div>
<a href="index.php?view=add_fields" class="btn btn-success">add input file</a>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>