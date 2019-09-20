<?php
require '../vendor/autoload.php';
require_once('../db.php');
require('../includes/head.php');
require('../includes/nav.php');

?>
<style>
  .register {
    margin: 0;
    padding: 0;
    background-color: #494f50;
    height: 100vh;
  }

  #login .container #login-row #login-column #login-box {
    margin-top: 120px;
    max-width: 600px;
    height: 320px;
    border: 1px solid #9c9c9c;
    background-color: #eaeaea;
  }

  #login .container #login-row #login-column #login-box #login-form {
    padding: 20px;
  }

  #login .container #login-row #login-column #login-box #login-form #register-link {
    margin-top: -85px;
  }
</style>

<div class="register" id="login">
  <h3 class="text-center text-white pt-5">Registration form</h3>
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
          <form id="login-form" class="form" action="../controller/register.php" method="post" onsubmit="return submitReg()" <h3 class="text-center text-info">Register</h3>
            <div class="form-group">
              <label for="username" class="text-info">Username:</label><br>
              <input type="text" name="username" id="username" class="form-control">
              <span class="text-danger" id="usernameError"></span>
            </div>
            <div class="form-group">
              <label for="password" class="text-info">Password:</label><br>
              <input type="password" name="pass" id="password" class="form-control" autocomplete="true">
              <span class="text-danger" id="passError"></span>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Register" class="btn btn-info btn-md">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
echo "
<script>
  function submitReg() {
    var username = document.getElementById('username').value
    var password = document.getElementById('password').value

    if (!username) {
      document.getElementById('usernameError').innerHTML = 'Invalid username!'
      return false
    }else{
      document.getElementById('usernameError').innerHTML = ''
    }
    if(!password){
      document.getElementById('passError').innerHTML = 'Please provide password!'
      return false
    }else{
      document.getElementById('passError').innerHTML = ''
    }
}
</script>
"
?>
<?php
require('../includes/foot.php');

?>