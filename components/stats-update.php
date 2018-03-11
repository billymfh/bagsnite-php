<?php
# Standalone, called via daemon or manual
# This is our entry point in to apigrabber.php
# It iterates through the names in the database and updates users stats

include "../config.php";
include $basePath . $includesDir.'database.php';
include $basePath . $includesDir."apigrabber.php";

$query = "SELECT * FROM `users`";

if ($result = $conn->query($query)){
  $row_cnt = $result->num_rows;
  if ($row_cnt < 1){
    if ($debugEnable == "true"){
      printf ("no results found... something bad happened\n");
    }
  } else {
    while ($row = $result->fetch_assoc()){
      $epicname = $row['epicname'];
      if ($epicname !== NULL){
        if ($debugEnable == "true"){
          echo $epicname . "\n";
        }
        updater("psn","$epicname");
        sleep($trnInterval);
        updater("pc","$epicname");
        sleep($trnInterval);
      }
    }
  }
  $result->close();
}

?>
