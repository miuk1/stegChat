<?php
session_start();
include('../class/class.user.php');
$user = new User();

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $pass = md5($pass);

  try {
    $login = $user->login_user($username, $pass);
    if ($login) {
      echo '<script type="text/javascript">
      window.location="http://localhost/stegChat/views/profile.php"
    </script>';
    } else {
      echo '<script type="text/javascript">alert("Login error. Please try again.")
      window.location="http://localhost/stegChat/"
      </script>';
    }
  } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
  }
}
