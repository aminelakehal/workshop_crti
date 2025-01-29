<?php
require_once __DIR__ . '/../../layout/header.php';
?>
<div class="container mt-5">
    <div class="titre mb-4">
        <h2>Add Organizational</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']); 
        }

        $fields = [
            'membres_O' => 'Organizational Members',
            'president_O' => 'Organizational President',
            'vice_president_O' => 'Organizational Vice President'
        ];

        foreach ($fields as $field => $label) {
            if (isset($_SESSION['errors'][$field])) {
                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['errors'][$field]) . '</div>';
            }
        }
        ?>

<style>
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268; 
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); 
        transform: translateY(-2px); 
    }

    .btn-secondary:active {
        background-color: #545b62;
        transform: translateY(0); 
        box-shadow: none; 
    }

    .btn-secondary.active {
        background-color: #28a745; 
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3); 
        transform: translateY(-2px); 
        color: white;
    }
</style>



        <div class="btn-group mb-3">
            <button type="button" class="btn btn-secondary" onclick="showForm('formMembres')">Membres Organisationnelle</button>
            <button type="button" class="btn btn-secondary" onclick="showForm('formPresident')">Président Organisationnelle</button>
            <button type="button" class="btn btn-secondary" onclick="showForm('formVicePresident')">Vice-président Organisationnelle</button>
        </div>

        <!-- Form Membres Organisationnelle -->
        <div id="formMembres" class="form-container">
            <form action="controllers/add/add_organisationnelle/add_membres.php" method="POST">
                <div class="form-group">
                    <label for="membres_O">Organizational Members</label>
                    <input type="text" class="form-control" id="membres_O" name="membres_O" value="<?php echo isset($_SESSION['data']['membres_O']) ? htmlspecialchars($_SESSION['data']['membres_O']) : ''; ?>" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php?view=organisationnelle" class="btn btn-secondary">Cancel</a>
            </form>
        </div>

        <!-- Form Président Organisationnelle -->
        <div id="formPresident" class="form-container" style="display:none;">
            <form action="controllers/add/add_organisationnelle/add_president.php" method="POST">
                <div class="form-group">
                    <label for="president_O">Organizational President</label>
                    <input type="text" class="form-control" id="president_O" name="president_O" value="<?php echo isset($_SESSION['data']['president_O']) ? htmlspecialchars($_SESSION['data']['president_O']) : ''; ?>" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php?view=organisationnelle" class="btn btn-secondary">Cancel</a>
            </form>
        </div>

        <!-- Form Vice-président Organisationnelle -->
        <div id="formVicePresident" class="form-container" style="display:none;">
            <form action="controllers/add/add_organisationnelle/add_vice_president_O.php" method="POST">
                <div class="form-group">
                    <label for="vice_president_O">Organizational Vice President</label>
                    <input type="text" class="form-control" id="vice_president_O" name="vice_president_O" value="<?php echo isset($_SESSION['data']['vice_president_O']) ? htmlspecialchars($_SESSION['data']['vice_president_O']) : ''; ?>" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php?view=organisationnelle" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script>
    function showForm(formId) {
        document.getElementById('formMembres').style.display = 'none';
        document.getElementById('formPresident').style.display = 'none';
        document.getElementById('formVicePresident').style.display = 'none';
        document.getElementById(formId).style.display = 'block';

        document.querySelectorAll('.btn-secondary').forEach(function(button) {
            button.classList.remove('active');
        });

        var activeButton;
        if (formId === 'formMembres') {
            activeButton = document.querySelector('button[onclick="showForm(\'formMembres\')"]');
        } else if (formId === 'formPresident') {
            activeButton = document.querySelector('button[onclick="showForm(\'formPresident\')"]');
        } else if (formId === 'formVicePresident') {
            activeButton = document.querySelector('button[onclick="showForm(\'formVicePresident\')"]');
        }

        if (activeButton) {
            activeButton.classList.add('active');
        }

        localStorage.setItem('activeForm', formId);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var activeForm = localStorage.getItem('activeForm');
        if (activeForm) {
            showForm(activeForm);
        } else {
            showForm('formMembres'); 
        }
    });

 
function hideMessages() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 1000); 
    }

    const errorMessages = document.querySelectorAll('.form-error');
    errorMessages.forEach((message) => {
        setTimeout(() => {
            message.style.display = 'none';
        }, 1000); 
    });
}

window.onload = hideMessages;


</script>


<?php
unset($_SESSION['errors']);
unset($_SESSION['data']);
require_once __DIR__ . '/../../layout/footer.php';
?>
