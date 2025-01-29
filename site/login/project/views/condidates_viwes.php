<?php
require_once __DIR__ . '/../controllers/condidats.php';
require_once __DIR__ . '/../layout/header.php';

?>

<div class="main-wrapper">
    <div class="titre">
        <h2>Liste des utilisateurs :</h2>
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
                        <th scope="col">Numéro de téléphone</th>
                        <th scope="col">Nom Secteur</th>
                        <th scope="col">Nom Établissement</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Nom Division</th>
                        <th scope="col">Autre</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $users_result = get_all_vue_utilisateur_complete($pdo);
                $i = 1;
                foreach ($users_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['user_prenom']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['user_nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['numero_telephone']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nom_sect']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nom_etablissement']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['statut']) . "</td>"; // Correction de 'staut' à 'statut'
                    echo "<td>" . htmlspecialchars($data['nom_div']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['other']) . "</td>";
                    echo "<td>";
                    echo "<a href=\"index.php?view=edit_user&id_edit=" . $data['id_user'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
                    echo "<a href=\"index.php?view=user&id_user=" . $data['id_user'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');\">Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php';?>