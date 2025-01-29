<?php
require_once __DIR__ . '/../controllers/delete.php';
require_once __DIR__ . '/../layout/header.php';
?>

<div class="main-wrapper">
    <div class="titre">
        <h2>Liste Admine :</h2>
    </div>
    
    <div class="mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $admin_result = get_all_admin($pdo);
                $i = 1;
                foreach ($admin_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['prenom_admin']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nom_admin']) . "</td>"; 
                    echo "<td>" . htmlspecialchars($data['email_admin']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['Role']) . "</td>"; 
                    echo "<td>";
                    echo "<a href=\"index.php?view=edit_admin&id_edit_admin=" . $data['id_admin'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
                    echo "<a href=\"index.php?view=Admin&id_admin=" . $data['id_admin'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');\">Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="index.php?view=add_admin" class="btn btn-success">Ajouter un utilisateur</a>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>

