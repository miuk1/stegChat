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

<div class="container" style="margin-top: 20px;">
  <div class="row">
    <div class="col-sm-6">
      <h3>Your Inbox</h3>
      <table class="table table-bordered table-responsive{-sm} table-hover">
        <?php
        if (count($messages) == 0) {
          echo 'No messages';
        } else {
          echo '  
  <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Sender Id</th>
        <th scope="col">Message Title</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>';

          foreach ($messages as $key => $message) {
            echo '<tr>
          <th scope="row">' . $key . '</th>
          <td>' . $message['sender_id'] . '</td>
          <td>' . $message['message_title'] . '</td>
          <td><a href="">Decode</a></td>
        </tr>';
          }
        }
        ?>
        </tbody>
      </table>
    </div>
    <div class="col-sm-6">
      <h3>Sent Messages</h3>
      <table class="table table-bordered table-hover table-responsive{-sm}">
        <?php
        if (count($sentmessages) == 0) {
          echo 'No messages sent';
        } else {
          echo '  
  <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Receiver Id</th>
        <th scope="col">Message Title</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>';

          foreach ($messages as $key => $message) {
            echo '<tr>
          <th scope="row">' . $key . '</th>
          <td>' . $message['receiver_id'] . '</td>
          <td>' . $message['message_title'] . '</td>
          <td><a href="">Decode</a></td>
        </tr>';
          }
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
require('../includes/foot.php');

?>