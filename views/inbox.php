<?php
session_start();
require '../vendor/autoload.php';
require('../includes/head.php');
require('../includes/nav.php');

include('../class/class.user.php');
$user = new User();

if ($_SESSION['login']) {
  $profile = $user->get_profile($_SESSION['uid']);
}

?>

<div class="container">
  <ul class="nav  nav-pills nav-justified justify-content-center">
    <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $profile['user_name'] ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="profile.php">Send</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Inbox</a>
    </li>

  </ul>
</div>

<div class="container">
  <h3>Your Inbox</h3>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Sender</th>
        <th scope="col">Message Title</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td><a href="">Decode</a></td>
      </tr>
    </tbody>
  </table>
</div>
<?php
require('../includes/foot.php');

?>