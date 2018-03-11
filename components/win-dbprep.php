<?php
# Called via cron or similar
# This is used to prep the `wins` table with data
# This is necessary because I have shoddy logic for determining wins
# and the default would be a 0 and you would see a wave of "wins" announced

include "../config.php";
include $basePath . $includesDir.'database.php';

$uquery = "SELECT * FROM `users`";

if ($uresult = $conn->query($uquery)){

  $row_cnt = $uresult->num_rows;
  if ($row_cnt < 1){
    if ($debugEnable == "true"){
      printf ("no results found... something bad happened\n");
    }
  } else {
    while ($row = $uresult->fetch_assoc()){
      $epicname = $row['epicname'];
      $querySoloPSN = "SELECT * FROM `solo.psn` WHERE epicname = '$epicname'";
      $querySoloPC = "SELECT * FROM `solo.pc` WHERE epicname = '$epicname'";
      $queryDuosPSN = "SELECT * FROM `duos.psn` WHERE epicname = '$epicname'";
      $queryDuosPC = "SELECT * FROM `duos.pc` WHERE epicname = '$epicname'";
      $querySquadsPSN = "SELECT * FROM `squads.psn` WHERE epicname = '$epicname'";
      $querySquadsPC = "SELECT * FROM `squads.pc` WHERE epicname = '$epicname'";
      $queryWinExists = "SELECT * FROM `wins` WHERE epicname = '$epicname'";

      if ($result = $conn->query($querySoloPSN)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){
          $winsSoloPSN = "0";
          } else {
            $obj = $result->fetch_object();
            $winsSoloPSN = $obj->top1;
          }
          $result->close();
        }
      if ($result = $conn->query($querySoloPC)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){
          $winsSoloPC = "0";
        } else {
            $obj = $result->fetch_object();
          $winsSoloPC = $obj->top1;
        }
        $result->close();
      }
      if ($result = $conn->query($queryDuosPSN)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){

          $winsDuosPSN = "0";
        } else {
            $obj = $result->fetch_object();
          $winsDuosPSN = $obj->top1;
        }
        $result->close();
      }
      if ($result = $conn->query($queryDuosPC)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){
          $winsDuosPC = "0";
        } else {
            $obj = $result->fetch_object();
          $winsDuosPC = $obj->top1;
        }
        $result->close();
      }
      if ($result = $conn->query($querySquadsPSN)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){
          $winsSquadsPSN = "0";
        } else {
            $obj = $result->fetch_object();
          $winsSquadsPSN = $obj->top1;
        }
        $result->close();
      }
      if ($result = $conn->query($querySquadsPC)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){
          $winsSquadsPC = "0";
        } else {
            $obj = $result->fetch_object();
          $winsSquadsPC = $obj->top1;
        }
        $result->close();
      }

      if ($result = $conn->query($queryWinExists)){
        $row_cnt = $result->num_rows;
        if ($row_cnt < 1){
          $dboperation = "Inserted";
          $queryWin = "INSERT INTO `wins` (epicname, solopc, solopsn, duospc, duospsn, squadspc, squadspsn)".
                    "VALUES ('$epicname','$winsSoloPC','$winsSoloPSN','$winsDuosPC','$winsDuosPSN','$winsSquadsPC','$winsSquadsPSN')";
        } else {
          $dboperation = "Updated";
          $queryWin = "UPDATE `wins` SET solopc = $winsSoloPC, solopsn = '$winsSoloPSN', duospc = '$winsDuosPC', duospsn = '$winsDuosPSN', squadspc = '$winsSquadsPC', squadspsn = '$winsSquadsPSN' WHERE epicname = '$epicname'";
        }
        if ($conn->query($queryWin) === TRUE) {
          if ($debugEnable == "true"){
            print "Win Prep: $dboperation successfully\n";
          }
        } else {
          if ($debugEnable == "true"){
            print "Win Prep: $dboperation failed!\n";
            print "Error: " . $queryWin . "\n" . $conn->error . "\n";
          }
        }
      }
    }
  }
}
 ?>
