<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="http://localhost/stegChat/index.php">StegChat</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li></li>
    </ul>
    <?php if (isset($_SESSION['login'])) {
      echo '
        <ul class="nav navbar-nav navbar-right">
        <li><a href="../controller/logout.php">Logout</a></li>
        </ul>
      ';
    } else {
      echo '<form class="form-inline my-2 my-lg-0" action="../controller/login.php" onsubmit="return submitLogin()" method="POST">
      <span class="text-danger" id="loginError"></span>
      <input class="form-control mr-sm-2" type="text" name="username" id="login_username" placeholder="Username">
      <input class="form-control mr-sm-2" type="password" name="pass" id="login_password" placeholder="Password" autocomplete="true">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit" value="Sign In">
    </form>';
    }
    ?>
  </div>
</nav>

<?php
echo "
<script>
  function submitLogin() {
    var username = document.getElementById('login_username').value
    var password = document.getElementById('login_password').value

    if (!username) {
      document.getElementById('loginError').innerHTML = 'Invalid username!'
      return false
    }else{
      document.getElementById('loginError').innerHTML = ''
    }
    if(!password){
      document.getElementById('loginError').innerHTML = 'Please provide password!'
      return false
    }else{
      document.getElementById('loginError').innerHTML = ''
    }
}
</script>
"
?>