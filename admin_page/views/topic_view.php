<?php
require_once __DIR__ . '/../controllers/controllers_topics.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Liste des  Topics:</h2>
    </div>

<!-- ========================== table president =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">topics</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $topics_result = get_all_topics($pdo);
                $i = 1;
                foreach ($topics_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['design_sujet']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                    echo "<td>";
                    echo "<a href=\"index.php?view=topic&id_sujet=" . $data['id_sujet'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
        </tbody>
    </table>
</div>
</div>
<a href="index.php?view=add_topic" class="btn btn-success">add Topic</a>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>