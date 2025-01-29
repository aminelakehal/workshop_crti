<?php
require_once __DIR__ . '/../controllers/controller_contenu.php';
require_once __DIR__ . '/../layout/header.php';
?>
 
 <div class="container mt-5">
 <div class="titre mb-4">
        <h2>Liste des Content :</h2>
    </div>

    <!-- ========================== table Content =============================== -->

    <div class="mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Intro video</th>
                        <th scope="col">PDF file for download</th>
                        <th scope="col">image About</th>
                        <th scope="col">Title About</th>
                        <th scope="col">Workshop Description 1</th>
                        <th scope="col">Workshop Description 2</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contenu_result = get_all_contenu($pdo);
                    $i = 1;
                    foreach ($contenu_result as $data) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $i++ . "</th>";
                        echo "<td><video src=\"" . htmlspecialchars($data['video_src']) . "\" alt=\"Intro Video\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                        echo "<td><a href=\"" . htmlspecialchars($data['download_link']) . "\" target=\"_blank\" class=\"btn btn-info\">Ouvrir PDF</a></td>";
                        echo "<td><img src=\"" . htmlspecialchars($data['about_image']) . "\" alt=\"About Image\" style=\"width:50px;height:50px;object-fit:cover;\"></td>";
                        echo "<td>" . htmlspecialchars($data['workshop_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['workshop_description1']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['workshop_description2']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                        echo "<td>";
                        echo "<a href=\"index.php?view=contenu&id_contenu=" . htmlspecialchars($data['id_contenu']) . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?> 
                </tbody>
            </table>
            <a href="index.php?view=add_contenu" class="btn btn-success mt-3">add Content</a>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/../layout/footer.php'; ?>
