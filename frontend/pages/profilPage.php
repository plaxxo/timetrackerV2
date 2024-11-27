<?php
include "..\components\header.php";
include "../components/navbar.php";
?>


<div class="container">
    <div class="row">
        <div class="col s2"></div>
        <div class="col s8">
            <div class="card grey lighten-4">
                <div class="card-content">
                    <form method="post" action="../../src/updateProfile.php">
                        <?php
                        if (isset($_SESSION['success_message'])) {
                            echo '<div class="green-text">' . $_SESSION['success_message'] . '</div>';
                            unset($_SESSION['success_message']);
                        } elseif (isset($_SESSION['error_message'])) {
                            echo '<div class="red-text">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']);
                        }
                        ?>
                        <span class="card-title"><h4>Profil</h4></span>
                        <p>
                            <b>Employee ID:   <?php echo $_SESSION['employeeId']; ?></b>
                        </p>
                        <br>
                        <div class="row">
                            <div class="col s6">
                                <p>
                                    <b>Vorname:</b>
                                    <input type="text" name="surname" value="<?php echo $_SESSION['surname']; ?>" placeholder="Vorname" disabled>
                                </p>
                            </div>
                            <div class="col s6">
                                <p>
                                    <b>Name:</b>
                                    <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" placeholder="Nachname" disabled>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6">
                                <p>
                                    <b>Username:</b>
                                    <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" placeholder="Username" disabled>
                                </p>
                            </div>
                            <div class="col s6">
                                <p>
                                    <b>Email:</b>
                                    <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Email" disabled>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 left-align">
                                <button type="button" class="btn" id="editButton">Bearbeiten</button>
                                <button type="submit" class="btn" id="saveButton" style="display: none;">Speichern</button>
                            </div>
                            <div class="col s6 right-align">
                                <a href="../../src/logout.php" class="btn red">Logout</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s2"></div>
    </div>
</div>

<script>
    const editButton = document.getElementById('editButton');
    const saveButton = document.getElementById('saveButton');
    const inputs = document.querySelectorAll('input[type="text"]');

    editButton.addEventListener('click', () => {
        inputs.forEach(input => input.disabled = false);
        editButton.style.display = 'none';
        saveButton.style.display = 'block';
    });
</script>