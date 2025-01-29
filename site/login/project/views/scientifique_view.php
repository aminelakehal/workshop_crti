<?php
// require_once __DIR__ . '/../controllers/delete_user.php';
require_once __DIR__ . '/../controllers/scientifique_controller.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="main-wrapper">
    <div class="titre">
        <h2>Liste des conscesion_scientifique:</h2>
    </div>
    
    <div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Président</th>
                        <th scope="col">Vice-président</th>
                        <th scope="col">Membres</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

        <?php
        $scientifique_result = get_all_conscesion_scientifique($pdo);
        $i = 1;
        foreach ($scientifique_result as $data) {
            echo "<tr>";
            echo "<th scope=\"row\">" . $i++ . "</th>";
            echo "<td>" . htmlspecialchars($data['Président']) . "</td>";
            echo "<td>" . htmlspecialchars($data['Vice-président']) . "</td>"; 
            echo "<td>" . htmlspecialchars($data['Membres']) . "</td>";
            echo "<td>";
            echo "<a href=\"edit_user.php?'id_scientifique=" . $data['id_scientifique'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
            echo "<a href=\"index.php?id_scientifique=" . $data['id_scientifique'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');\">Supprimer</a>";
            
            
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</div>


























<?php require_once __DIR__ . '/../layout/footer.php';?>




















