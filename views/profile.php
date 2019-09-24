<?php
session_start();
require '../vendor/autoload.php';
require('../includes/head.php');
require('../includes/nav.php');

include('../class/class.user.php');
$user = new User();

if (isset($_SESSION['login'])) {
  $profile = $user->get_profile($_SESSION['uid']);
  $users = $user->get_users($profile['user_id']);

  echo '
<div class="container">
  <ul class="nav  nav-pills nav-justified justify-content-center">
    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">' . $profile['user_name'] . '</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Send</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="inbox.php">Inbox</a>
    </li>

  </ul>
</div>';


  require('send.php');
} else {
  echo 'Please login';
}
require('../includes/foot.php');
