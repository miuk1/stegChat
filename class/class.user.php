<?php
require '../vendor/autoload.php';
include('../db.php');
class user
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

  public function reg_user($username, $password)
  {
    $sql1 = "SELECT * FROM users WHERE user_name = '$username'";
    $check_user = mysqli_query($this->db, $sql1);
    $count_row = mysqli_num_rows($check_user);
    if ($count_row == 0) {
      $sql = "INSERT INTO users SET user_name = '$username', password = '$password'";
      $result = mysqli_query($this->db, $sql) or die(mysqli_connect_error() . "Registration failed");
      return $result;
    } else {
      return false;
    }
  }

  public function login_user($username, $password)
  {
    $sql = "SELECT * FROM users WHERE user_name = '$username' AND password = '$password'";
    $result = mysqli_query($this->db, $sql) or die(mysqli_connect_error() . "Login failed");
    $user_data = mysqli_fetch_assoc($result);
    $count_user = mysqli_num_rows($result);
    if ($count_user == 1) {
      $_SESSION['login'] = true;
      $_SESSION['uid'] = $user_data["user_id"];
      return true;
    } else {
      return false;
    }
  }

  public function get_profile($uid)
  {
    $sql = "SELECT * FROM users WHERE user_id = '$uid'";
    $result = mysqli_query($this->db, $sql) or die(mysqli_connect_error() . "Profile Error");
    $count_user = mysqli_num_rows($result);
    $profile_data = mysqli_fetch_assoc($result);
    if ($count_user == 1) {
      return $profile_data;
    } else {
      return null;
    }
  }

  public function logout()
  {
    $_SESSION['login'] = false;
    session_unset();
    session_destroy();
    return true;
  }


  public function get_users($userid)
  {
    $sql = "SELECT user_name from users WHERE  NOT user_id = $userid";
    $result = mysqli_query($this->db, $sql) or die(mysqli_connect_error() . "Fetching users failed");
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }
}
