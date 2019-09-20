<?php

include('../class/class.user.php');
$user = new User();

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $pass = md5($pass);

  try {
    $register = $user->reg_user($username, $pass);
    if ($register) {
      echo '<script type="text/javascript">
      alert("Registration Successful! Please login to send messages")
      window.location="http://localhost/stegChat/index.php"
    </script>';
    } else {
      echo '<script>alert("Registration failed.Username already exits please try again")
      window.location="http://localhost/stegChat/views/register.php"</script>
      ';
    }
    exit();
  } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
  }
}
