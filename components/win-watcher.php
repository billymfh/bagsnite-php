<?php
# Called via daemon or cron
# This will roll through the stats tables and compare wins to
# the wins table. If it detects that the stat is 1 greater
# than the wins table, it will announce the win and update the wins tables
# the logic sucks, which requires dbprep to prevent spamming wins.
# additionally, it is possible that if the player manages more than one win
# it will break win announcements for that user forever (or until fixed)
# also note that the watcher will ignore checking for players
# without a wins table row, which means you have to prep the db
# with win-dbprep.php

include "../config.php";
include $basePath . $includesDir.'database.php';
include $basePath . $includesDir . 'slack.php';

function getSoloWinsPSN($epicname){
  global $conn;
  $query = "SELECT * FROM `solo.psn` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      $wins = "0";
      return $wins;
    } else {
      $obj = $result->fetch_object();
      $wins = $obj->top1;
      return $wins;

    }
    $result->close();
  }
}

function getDuosWinsPSN($epicname){
  global $conn;
  $query = "SELECT * FROM `duos.psn` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      $wins = "0";
      return $wins;
    } else {
      $obj = $result->fetch_object();
      $wins = $obj->top1;
      return $wins;

    }
    $result->close();
  }
}

function getSquadsWinsPSN($epicname){
  global $conn;
  $query = "SELECT * FROM `squads.psn` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      $wins = "0";
      return $wins;
    } else {
      $obj = $result->fetch_object();
      $wins = $obj->top1;
      return $wins;

    }
    $result->close();
  }
}

function getSoloWinsPC($epicname){
  global $conn;
  $query = "SELECT * FROM `solo.pc` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      $wins = "0";
      return $wins;
    } else {
      $obj = $result->fetch_object();
      $wins = $obj->top1;
      return $wins;

    }
    $result->close();
  }
}

function getDuosWinsPC($epicname){
  global $conn;
  $query = "SELECT * FROM `duos.pc` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      $wins = "0";
      return $wins;
    } else {
      $obj = $result->fetch_object();
      $wins = $obj->top1;
      return $wins;
    }
    $result->close();
  }
}

function getSquadsWinsPC($epicname){
  global $conn;
  $query = "SELECT * FROM `squads.pc` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      $wins = "0";
      return $wins;
    } else {
      $obj = $result->fetch_object();
      $wins = $obj->top1;
      return $wins;

    }
    $result->close();
  }
}

function checkWins($epicname){
  global $conn;
  $query = "SELECT * FROM `wins` WHERE epicname = '$epicname'";
  if ($result = $conn->query($query)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      return 0;
    } else {
      $obj = $result->fetch_object();
      $solopc     = $obj->solopc;
      $solopsn    = $obj->solopsn;
      $duospc     = $obj->duospc;
      $duospsn    = $obj->duospsn;
      $squadspc   = $obj->squadspc;
      $squadspsn  = $obj->squadspsn;
      $winArray = [
        "solopc"    => $solopc,
        "solopsn"   => $solopsn,
        "duospc"    => $duospc,
        "duospsn"   => $duospsn,
        "squadspc"  => $squadspc,
        "squadspsn" => $squadspsn,
      ];
      return $winArray;
    }
    $result->close();
  }
}

function updateWins($fieldname, $epicname, $newtotal){
  global $conn;
  $aquery = "SELECT $fieldname FROM `wins` WHERE epicname = '$epicname'";
  if ($result = $conn->query($aquery)){
    $row_cnt = $result->num_rows;
    if ($row_cnt < 1){
      //$dboperation = "Inserted";
      //$bquery = "INSERT INTO `wins` ($fieldname, epicname)".
      //          "VALUES ('$newtotal', '$epicname')";
      $retmessage = "Winprep hasn't occurred yet";
      return $retmessage;
    } else {
      $dboperation = "Updated";
      $bquery = "UPDATE `wins` SET $fieldname = $newtotal WHERE epicname = '$epicname'";
    }
    if ($conn->query($bquery) === TRUE) {
      $retmessage = "wins $dboperation successfully\n";
      return $retmessage;
    } else {
      $retmessage =  "wins $dboperation failed!\n Error: " . $bquery . "\n" . $conn->error . "\n";
      return $retmessage;
    }
  }
}

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
      $slackname = $row['slackname'];
      if ($epicname !== NULL){
        if ($debugEnable == "true"){
          echo "Debug, looping on " . $epicname . "\n";
        }
        if (getSoloWinsPSN($epicname) == checkWins($epicname)["solopsn"]+1){
          if ($debugEnable == "true"){
            echo "$epicname Solo PSN WINNER!\n";
          }
          slackNotify($slackname);
          $newtotal = getSoloWinsPSN($epicname);
          echo updateWins("solopsn", $epicname, $newtotal);
        }
        if (getSoloWinsPC($epicname) == checkWins($epicname)["solopc"]+1){
          if ($debugEnable == "true"){
            echo "$epicname Solo PC WINNER!\n";
          }
          slackNotify($slackname);
          $newtotal = getSoloWinsPC($epicname);
          echo updateWins("solopc", $epicname, $newtotal);
        }
        if (getDuosWinsPSN($epicname) == checkWins($epicname)["duospsn"]+1){
          if ($debugEnable == "true"){
            echo "$epicname Duos PSN WINNER!\n";
          }
          slackNotify($slackname);
          $newtotal = getDuosWinsPSN($epicname);
          echo updateWins("duospsn", $epicname, $newtotal);
        }
        if (getDuosWinsPC($epicname) == checkWins($epicname)["duospc"]+1){
          if ($debugEnable == "true"){
            echo "$epicname Duos PC WINNER!\n";
          }
          slackNotify($slackname);
          $newtotal = getDuosWinsPC($epicname);
          echo updateWins("duospc", $epicname, $newtotal);
        }
        if (getSquadsWinsPC($epicname) == checkWins($epicname)["squadspc"]+1){
          if ($debugEnable == "true"){
            echo "$epicname Squads PC WINNER!\n";
          }
          slackNotify($slackname);
          $newtotal = getSquadsWinsPC($epicname);
          echo updateWins("squadspc", $epicname, $newtotal);
        }
        if (getSquadsWinsPSN($epicname) == checkWins($epicname)["squadspsn"]+1){
          if ($debugEnable == "true"){
            echo "$epicname Squads PSN WINNER!\n";
          }
          slackNotify($slackname);
          $newtotal = getSquadsWinsPSN($epicname);
          echo updateWins("squadspsn", $epicname, $newtotal);
        }
      }
    }
  }
  $result->close();
}

?>
