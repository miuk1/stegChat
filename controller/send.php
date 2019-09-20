<?php

include('../class/class.messages.php');
$message = new Messages();

if (isset($_POST['submit'])) {
  $messageTitle = $_POST['messageTitle'];
  $receiver = $_POST['receiver'];
  $senderid = $_POST['sender'];
  $secretMessage = $_POST['secretMessage'];
  $file = 'i am file';
  $seen = false;

  $receiverid = $message->fetch_receiver($receiver);

  $user_list = $message->get_users($senderid);

  $sendMessage = $message->send_message($messageTitle, $file, $senderid, $receiverid, $seen);
  if ($sendMessage) {
    die('Message Sent Successfully');
  } else {
    die('Message could not be sent');
  }
}
