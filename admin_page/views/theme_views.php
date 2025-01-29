
<?php
require_once __DIR__ . '/../controllers/controllers_theme.php';
require_once __DIR__ . '/../layout/header.php';
?>





<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Liste des theme :</h2>
    </div>

<!-- ========================== table registration_info  =============================== -->

<div class=" mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>

                    <th>title Workshop</th>
                    <th>presedant workshop</th>
                        <th>Description</th>
                      <th>Paper Submission Date</th>
                     <th>Acceptance Notification Date</th>
                    <th>Workshop Dates</th>
                    <th>Additional Info</th>
                    <th>Admin</th>
                     <th>Registration Fee</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $registration_info_result = get_theme($pdo);
                $i = 1;
                foreach ($registration_info_result as $data) {
                    echo "<tr>";

                    echo "<td>" . htmlspecialchars($data['title_home']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['presedant_workshop']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['paper_submission_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['acceptance_notification_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['workshop_dates']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['additional_info']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['admin_name']) . "</td>";

                    echo "<td>" . number_format(htmlspecialchars($data['registration_fee']), 2, ',', '.') . " DA</td>";
                    echo "<td>";
                    // echo "<a href=\"update_registration?id_theme=" . $data['id_theme'] . "\" class=\"btn btn-primary\">Modifier</a> | ";
                    echo "<a href=\"index.php?view=theme&id_theme=" . $data['id_theme'] . "\" class=\"btn btn-danger\" onclick=\"return confirm('Are you sure you want to delete ?');\">delete</a>";
                    
                    echo "</td>";
                    echo "</tr>";
                }
                ?> 
        </tbody>
    </table>
</div>
</div>
<a href="index.php?view=add_theme_view" class="btn btn-success">add theme</a>

<?php require_once __DIR__ . '/../layout/footer.php';?>