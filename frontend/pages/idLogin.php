<?php
include "..\components\header.php";
?>

<body>
  <div class="container">
    <div class="row">
      <div class="col s12 m6 offset-m3">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Login</span>
            <?php
            session_start();
              if (isset($_SESSION['error_message'])) {
                echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
              }
              session_destroy()
            ?>
            <form action="..\..\src\idLogin.php" method="post">
              <div class="input-field">
                <input type="text" name="employeeID" id="employeeID" required>
                <label for="employeeID">Mitarbeiternummer</label>
              </div>
              <button class="btn waves-effect waves-light" type="submit" name="submit">Anmelden</button>
            </form>
            <br>
            <p>Karte vergessen? <a href="userLogin.php">Zum Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>