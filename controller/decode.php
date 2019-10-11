<?php
session_start();
require '../vendor/autoload.php';
require('../includes/head.php');
require('../includes/nav.php');

include('../class/class.user.php');
$user = new User();

if ($_SESSION['login']) {
  $profile = $user->get_profile($_SESSION['uid']);
  $messages = $user->fetch_messages($_SESSION['uid']);
  $sentmessages = $user->fetch_sentmessages($_SESSION['uid']);
}

$stegoContainer = new Picamator\SteganographyKit\StegoContainer();

$encoded_file = $_GET['link'];

// stego-image.png
$secretText = $stegoContainer->decode($encoded_file);

?>

<div class="container">
  <ul class="nav  nav-pills nav-justified justify-content-center">
    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $profile['user_name'] ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="../views/profile.php">Send</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Decoded Message</a>
    </li>

  </ul>
</div>

<div class="container">
  <h3 style="text-align: center;">Here is your message</h3>
  <p style="text-align: center; background-color: #edf2f7; padding: 10px;">
    <?php
    echo $secretText;
    ?>
  </p>
</div>