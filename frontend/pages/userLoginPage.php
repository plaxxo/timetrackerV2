<?php
include "..\components\header.php";
?>

<body class="body-login">
  <div class="container">
    <div class="row">
      <div class="col s12 m6 offset-m3">
        <div class="card card-login">
          <div class="card-content ">
            <span class="card-title">Login</span>
            <?php
              if (isset($_SESSION['error_message'])) {
                echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
              }
            ?>
            <form action="..\..\src\userLogin.php" method="post">
              <div class="input-field">
                <input type="text" name="username" id="username" required>
                <label for="username">Benutzername</label>
              </div>
              <div class="input-field">
                <input type="password" name="password" id="password" required>
                <label for="password">Passwort</label>
              </div>
              <button class="btn waves-effect waves-light" type="submit" name="submit">Anmelden</button>
            </form>
            <br>
            <p>Karte dabei? <a href="idLoginPage.php">Zum Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>