<?php

include('../class/class.user.php');
$user = new User();
$logout = $user->logout();
if ($logout) {
  header('Location: http://localhost/stegChat/');
} else {
  die('Cannot Logout');
}
