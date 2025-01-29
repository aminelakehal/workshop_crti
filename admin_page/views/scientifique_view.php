<?php
require_once __DIR__ . '/../controllers/scientifique_controller.php';
require_once __DIR__ . '/../controllers/delete.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Liste des scientific:</h2>
    </div>

<!-- ========================== table president =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <a href="index.php?view=add_scientific" class="btn btn-success">add scientific</a>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">president____scientific</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $scientific_result = get_all_concession_scientific($pdo);
                $i = 1;
                foreach ($scientific_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['president_S']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                    echo "<td>";
                    // echo "<a href=\"edit_user.php?id_president_S=" . $data['id_president_S'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
                    echo "<a href=\"index.php?view=scientifique&id_president_S=" . $data['id_president_S'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
        </tbody>
    </table>
</div>
</div>



    <!-- ========================== table membres_Srganisationnelle  =============================== -->
    <div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Membres_____scientific</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
        $scientific_result = get_all_membres_scientific($pdo);
        $i = 1;
        foreach ($scientific_result as $data) {
            echo "<tr>";
            echo "<th scope=\"row\">" . $i++ . "</th>";
            echo "<td>" . htmlspecialchars($data['membres_S']) . "</td>";
            echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
            echo "<td>";
            echo "<a href=\"index.php?view=scientifique&id_membres_S=" . $data['id_membres_S'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
            
            
            echo "</td>";
            echo "</tr>";
        }
        ?> 
        </tbody>
    </table>
</div>
</div>


<!-- ========================== table vice_president_scientific  =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vice_president_scientific</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>

                <?php
        $scientific_result = get_all_vice_president_scientific($pdo);
        $i = 1;
        foreach ($scientific_result as $data) {
            echo "<tr>";
            echo "<th scope=\"row\">" . $i++ . "</th>";
            echo "<td>" . htmlspecialchars($data['V_president_S']) . "</td>";
            echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
            echo "<td>";
            // echo "<a href=\"edit_user.php?id_vice_president_S=" . $data['id_vice_president_S'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
            echo "<a href=\"index.php?view=scientifique&id_Vpresident_S=" . $data['id_Vpresident_S'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
            echo "</td>";
            echo "</tr>";
}
?>


        </tbody>
    </table>
</div>
</div>






<?php require_once __DIR__ . '/../layout/footer.php';?>