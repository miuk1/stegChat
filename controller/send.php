<?php
require '../vendor/autoload.php';
include('../class/class.messages.php');
$message = new Messages();
$stegoContainer = new Picamator\SteganographyKit\StegoContainer();


if (isset($_POST['submit'])) {
  $messageTitle = $_POST['messageTitle'];
  $receiver = $_POST['receiver'];
  $senderid = $_POST['sender'];
  $secretMessage = $_POST['secretMessage'];
  $fileUploadDir = "../uploads/";
  $uploadedFile = $fileUploadDir . basename($_FILES["messageImage"]["name"]);
  $uploadStatus = 0;
  $fileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
  $seen = false;

  $check = getimagesize($_FILES["messageImage"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadStatus = 1;
  } else {
    echo "File is not an image.";
    $uploadStatus = 0;
  }

  // Check file size
  if ($_FILES["messageImage"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadStatus = 0;
  }

  // Allow certain file formats
  if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadStatus = 0;
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadStatus == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    $stegoContainer->encode($_FILES["messageImage"]["tmp_name"], '../uploads/' . $_FILES["messageImage"]["name"], $secretMessage);
  }



  $receiverid = $message->fetch_receiver($receiver);

  $sendMessage = $message->send_message($messageTitle, $uploadedFile, $senderid, $receiverid, $seen);
  if ($sendMessage) {
    echo '<script>alert("Message Sent Successfully")
    </script>';
  } else {
    die('Message could not be sent');
  }
}
