<?php
require_once __DIR__ . '/../controllers/delete.php';
require_once __DIR__ . '/../layout/header.php';
?>
<div class="container mt-5">
<div class="titre mb-4">
        <h2>Liste des organisationnelle  :</h2>
    </div>

<!-- ========================== table president =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <a href="index.php?view=add_organisationnelle" class="btn btn-success">add organisationnelle</a>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">president____Organisationnelle</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $organisationnelle_result = get_all_president_organisationnelle($pdo);
                $i = 1;
                foreach ($organisationnelle_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['president_O']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
                    echo "<td>";
                    // echo "<a href=\"edit_user.php?id_president_O=" . $data['id_president_O'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
                    echo "<a href=\"index.php?view=organisationnelle&id_president_O=" . $data['id_president_O'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
        </tbody>
    </table>
</div>
</div>



    <!-- ========================== table membres_organisationnelle  =============================== -->
    <div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Membres_____Organisationnelle</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
        $organisationnelle_result = get_all_membres_organisationnelle($pdo);
        $i = 1;
        foreach ($organisationnelle_result as $data) {
            echo "<tr>";
            echo "<th scope=\"row\">" . $i++ . "</th>";
            echo "<td>" . htmlspecialchars($data['membres_O']) . "</td>";
            echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
            echo "<td>";
            // echo "<a href=\"edit_user.php?id_membres_O=" . $data['id_membres_O'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
            echo "<a href=\"index.php?view=organisationnelle&id_membres_O=" . $data['id_membres_O'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
            
            
            echo "</td>";
            echo "</tr>";
        }
        ?> 
        </tbody>
    </table>
    <!-- <a href="index.php?view=add_organisationnelle" class="btn btn-success">Ajouter un organisationnelle</a> -->
</div>
</div>


<!-- ========================== table vice_president_organisationnelle  =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vice_president_Organisationnelle</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>

                <?php
        $organisationnelle_result = get_all_vice_president_organisationnelle($pdo);
        $i = 1;
        foreach ($organisationnelle_result as $data) {
            echo "<tr>";
            echo "<th scope=\"row\">" . $i++ . "</th>";
            echo "<td>" . htmlspecialchars($data['vice_president_O']) . "</td>";
            echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";
            echo "<td>";
            // echo "<a href=\"edit_user.php?id_vice_president_o=" . $data['id_vice_president_o'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
            echo "<a href=\"index.php?view=organisationnelle&id_vice_president_o=" . $data['id_vice_president_o'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
            echo "</td>";
            echo "</tr>";
}
?>


        </tbody>
    </table>
    <!-- <a href="index.php?view=add_organisationnelle" class="btn btn-success">Ajouter un organisationnelle</a> -->
</div>
</div>






<?php require_once __DIR__ . '/../layout/footer.php';?>