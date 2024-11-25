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
            <form action="login.php" method="post">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</body>