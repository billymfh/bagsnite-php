<?php
# this is a component and not loaded directly
# it is used by the accounts element to update account info

include "../config.php";
include $basePath . $includesDir . "database.php";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$epicname = $_POST['epicname'];
$slackname = $_POST['slackname'];
$psnname = $_POST['psnname'];
$nickname = $_POST['nickname'];
$google_userid = $_POST['google_userid'];

if (empty($_POST['google_userid']))
    $errors['google_userid'] = 'User ID is required.';

// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

      $query = "UPDATE users SET epicname = '$epicname', slackname = '$slackname', psnname = '$psnname', nickname = '$nickname' WHERE google_userid = '$google_userid'";
      if ($conn->query($query) === TRUE) {
        if ($debugEnable == "true"){
          echo "Inserted successfully\n";
        }
      } else {
        if ($debugEnable == "true"){
          echo "Insert failed!\n";
          echo "Error: " . $query . "\n" . $conn->error . "\n";
        }
      }
        // show a message of success and provide a true success variable
        //$data['success'] = true;
        //$data['message'] = 'Success!';
    }

    // return all our data to an AJAX call
    //echo json_encode($data);
    echo "Updated!";
  ?>
