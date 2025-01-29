<?php
require_once __DIR__ . '/../controllers/condidats.php';
require_once __DIR__ . '/../controllers/controller_fields.php';
require_once __DIR__ . '/../layout/header.php';


$user_files = get_uploaded_files_by_user($pdo);
$file_fields = get_all_file_fields($pdo); 

?>
<style>
    .file-link {
        display: inline-block;
        margin: 2px;
        padding: 5px 10px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        text-decoration: none;
        color: #495057;
        font-size: 0.9em;
    }
    .file-link:hover {
        background-color: #e9ecef;
    }
    .file-cell {
        max-width: 200px;
        word-wrap: break-word;
    }
</style>

<div class="container mt-5">
<div class="titre mb-4">
        <h2>User List and Uploaded Files:</h2>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">etablissement</th>
                    <th scope="col">nom_etablissement</th>
                    <th scope="col">Sector</th>
                    <th scope="col">Division</th>
                    <?php foreach ($file_fields as $field): ?>
                        <th scope="col"><?php echo htmlspecialchars($field['field_name']); ?></th>
                    <?php endforeach; ?>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $user_files_map = []; 
            
            // Group files by institution
            foreach ($user_files as $data) {
                $user_id = $data['id_etablissement'];
                if (!isset($user_files_map[$user_id])) {
                    $user_files_map[$user_id] = [];
                }
                $user_files_map[$user_id][] = $data;
            }
            
            foreach ($user_files_map as $user_id => $files) {
                $first_file = reset($files);
                echo "<tr>";
                echo "<th scope=\"row\">" . $i++ . "</th>";
                echo "<td>" . htmlspecialchars($first_file['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($first_file['nom']) . "</td>"; 
                echo "<td>" . htmlspecialchars($first_file['email']) . "</td>";
                echo "<td>" . htmlspecialchars($first_file['numero_telephone']) . "</td>";
                echo "<td>" . htmlspecialchars($first_file['etablissement']) . "</td>";
                echo "<td>" . htmlspecialchars($first_file['nom_etablissement']) . "</td>";
                echo "<td>" . htmlspecialchars($first_file['secteur_name']) . "</td>";
                echo "<td>" . htmlspecialchars($first_file['division_name']) . "</td>";
                
                // Initialize upload time and date
                $upload_date = 'N/A';
                
                // Display file fields
                foreach ($file_fields as $field) {
                    $file_field_name = $field['field_name'];
                    $file_link = '';
                    
                    foreach ($files as $file) {
                        if ($file['field_name'] === $file_field_name) {
                            $file_link .= "<a href=\"" . htmlspecialchars($file['file_path']) . "\" target=\"_blank\" class=\"btn btn-info\">" . htmlspecialchars($file['file_name']) . "</a><br>";


                            
                            // Keep the last upload date
                            $upload_date = htmlspecialchars($file['upload_date']);
                        }
                    }
                    
                    echo "<td>" . $file_link . "</td>";
                }
                
                // Display the upload date
                echo "<td>" . $upload_date . "</td>";
                
                echo "<td>";
                echo "<a href=\"index.php?view=condidates&id_etablissement=" . $user_id . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
