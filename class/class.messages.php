<?php
require '../vendor/autoload.php';
include('../db.php');

class messages
{
  public $db;
  public function __construct()
  {
    $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (mysqli_connect_errno()) {
      echo "Error: Could not connect to database";
      exit;
    }
  }

  public function fetch_receiver($receivername)
  {
    $sql = "SELECT * from users WHERE user_name = '$receivername'";
    $result = mysqli_query($this->db, $sql) or die(mysqli_connect_error() . "Cannot connect to database");
    $user_data = mysqli_fetch_assoc($result);
    $count_user = mysqli_num_rows($result);
    if ($count_user == 1) {
      return $user_data['user_id'];
    } else {
      die('Cannot find username');
    }
  }

  public function send_message($messageTitle, $file, $senderid, $receiverid, $seen)
  {
    $sql = "INSERT INTO messages SET sender_id = '$senderid', receiver_id = '$receiverid', message_title = '$messageTitle', message_file = '$file', seen = '$seen' ";
    $result = mysqli_query($this->db, $sql) or die(mysqli_connect_error() . "Sending message failed");
    return $result;
  }
}
