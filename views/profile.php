<?php
session_start();
require '../vendor/autoload.php';
require('../includes/head.php');
require('../includes/nav.php');

include('../class/class.user.php');
$user = new User();

if ($_SESSION['login']) {
  $profile = $user->get_profile($_SESSION['uid']);
  $users = $user->get_users($profile['user_id']);
}

?>

<div class="container">
  <ul class="nav  nav-pills nav-justified justify-content-center">
    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $profile['user_name'] ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Send</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="inbox.php">Inbox</a>
    </li>

  </ul>
</div>
<?php
require('send.php');
require('../includes/foot.php');

?>