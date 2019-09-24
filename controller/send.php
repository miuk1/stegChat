<?php

include('../class/class.messages.php');
$message = new Messages();

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
    if (move_uploaded_file($_FILES["messageImage"]["tmp_name"], $uploadedFile)) {
      echo "The file " . basename($_FILES["messageImage"]["name"]) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }



  $receiverid = $message->fetch_receiver($receiver);

  /*$sendMessage = $message->send_message($messageTitle, $file, $senderid, $receiverid, $seen);
  if ($sendMessage) {
    echo '<script>alert("Message Sent Successfully")
        window.location = "http://localhost/stegChat/views/profile.php";
    </script>';
  } else {
    die('Message could not be sent');
  }
  */
}
