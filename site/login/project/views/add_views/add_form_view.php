<?php
require_once __DIR__ . '/../../layout/header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter des Champs</h2>
    <form action="controllers/add/add_form.php" method="post">
        <div id="fields">
            <div class="field-group mb-3 row">
                <div class="col-md-6 mb-2">
                    <input type="text" class="form-control" name="field_name[]" placeholder="Nom du champ">
                </div>
                <div class="col-md-6 mb-2">
                    <select class="form-select" name="field_type[]">
                        <option value="text">Texte</option>
                        <option value="number">Nombre</option>
                        <option value="date">Date</option>
                        <option value="email">Email</option>
                        <option value="password">Mot de passe</option>
                        <option value="file">Fichier</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-secondary" onclick="addField()">Ajouter un champ</button>
            <button type="submit" class="btn btn-primary">Enregistrer les champs</button>
        </div>
    </form>
</div>
<script>
    function addField() {
        const container = document.getElementById("fields");
        const fieldGroup = document.createElement("div");
        fieldGroup.className = "field-group mb-3 row";

        fieldGroup.innerHTML = `
            <div class="col-md-6 mb-2">
                <input type="text" class="form-control" name="field_name[]" placeholder="Nom du champ">
            </div>
            <div class="col-md-6 mb-2">
                <select class="form-select" name="field_type[]">
                    <option value="text">Texte</option>
                    <option value="number">Nombre</option>
                    <option value="date">Date</option>
                    <option value="email">Email</option>
                    <option value="password">Mot de passe</option>
                    <option value="file">Fichier</option>
                </select>
            </div>
        `;

        container.appendChild(fieldGroup);
    }
</script>

<?php
require_once __DIR__ . '/../../layout/footer.php';
?>