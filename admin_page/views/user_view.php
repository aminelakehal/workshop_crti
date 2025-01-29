<?php
require_once __DIR__ . '/../controllers/delete.php';
require_once __DIR__ . '/../layout/header.php';

$users_result = get_all_user($pdo); 
?>

<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . '</div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</div>';
    }
    unset($_SESSION['errors']);
}
?>

<div class="container mt-5">
<div class="titre mb-4">
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
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($users_result as $data) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i++ . "</th>";
                    echo "<td>" . htmlspecialchars($data['prenom'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($data['nom'], ENT_QUOTES, 'UTF-8') . "</td>"; 
                    echo "<td>" . htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($data['numero_telephone'], ENT_QUOTES, 'UTF-8') . "</td>"; 
                    echo "<td>";
                    echo "<a href=\"index.php?view=edit_user&id_edit=" . htmlspecialchars($data['id_user'], ENT_QUOTES, 'UTF-8') . "\" class=\"btn btn-primary\">Edit</a> | ";
                    echo "<a href=\"index.php?view=user&id_user=" . htmlspecialchars($data['id_user'], ENT_QUOTES, 'UTF-8') . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <!-- <a href="index.php?view=add_user" class="btn btn-success">Ajouter un utilisateur</a> -->
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
