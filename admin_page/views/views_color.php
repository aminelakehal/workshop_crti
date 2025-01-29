<?php
require_once __DIR__ . '/../controllers/controller_color.php';
require_once __DIR__ . '/../layout/header.php';

$color_result = get_all_color_site($pdo); 
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
                    <th scope="col">Text Color</th>
                    <th scope="col">Background Color</th>
                    <th scope="col">Hover Background Color</th>
                    <th scope="col">Body Background Color</th>
                    <th scope="col">Footer Background Color</th>
                    <th scope="col">Color title</th>
                    <th scope="col">H2 Color</th>
                    <th scope="col">H3 Color</th>
                    <th scope="col">Color title workshop</th>
                    <th scope="col">H5 Color</th>
                    <th scope="col">Color text content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    foreach ($color_result as $data) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . $i++ . "</th>";
                        echo "<td style=\"color: " . htmlspecialchars($data['text_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['text_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"background-color: " . htmlspecialchars($data['bg_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['bg_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"background-color: " . htmlspecialchars($data['bg_color_hover'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['bg_color_hover'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"background-color: " . htmlspecialchars($data['bg_color_body'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['bg_color_body'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"background-color: " . htmlspecialchars($data['footer_background'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['footer_background'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"color: " . htmlspecialchars($data['h1_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['h1_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"color: " . htmlspecialchars($data['h2_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['h2_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"color: " . htmlspecialchars($data['h3_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['h3_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"color: " . htmlspecialchars($data['h4_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['h4_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"color: " . htmlspecialchars($data['h5_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['h5_color'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td style=\"color: " . htmlspecialchars($data['h6_color'], ENT_QUOTES, 'UTF-8') . ";\">" . htmlspecialchars($data['h6_color'], ENT_QUOTES, 'UTF-8') . "</td>";

                        echo "<td>";
                        echo "<a href=\"index.php?view=edit_color&id_edit_color=" . htmlspecialchars($data['id_color'], ENT_QUOTES, 'UTF-8') . "\" class=\"btn btn-primary\">Edit</a> | ";
                        echo "<a href=\"index.php?view=color&id_color=" . htmlspecialchars($data['id_color'], ENT_QUOTES, 'UTF-8') . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
    

                </tbody>
            </table>
            <a href="index.php?view=add_color" class="btn btn-success">add_color </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
