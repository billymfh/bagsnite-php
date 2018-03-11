<?php
# File used as an include
# The provides the function "updater" which reaches out to TRN/Fortnite Tracker
# While it is capable of writing a file, that's not recommended and will not provide
# data to the rest of the web app.

function updater($platform,$epicname){
  include "../config.php";
  include $basePath . $includesDir.'database.php';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/$platform/$epicname");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'TRN-Api-Key: '. $trnFortniteKey
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  if ($trnWriteFile == "true"){
    echo "writing stats.json";
    $fp = fopen("./tmp/stats.json", "w");
    fwrite($fp, $response);
    fclose($fp);
  }

  // this is for file based only
  if ($trnWriteFile == "true"){
    $data = json_decode(file_get_contents("./tmp/stats.json"));
  } else {
    $data = json_decode($response);
  }

  // game mode types
  if (isset($data->stats->p2))
    $solo     = $data->stats->p2; //solos data
  if (isset($data->stats->p10))
    $duos     = $data->stats->p10;//duos data
  if (isset($data->stats->p9))
    $squads   = $data->stats->p9;//squads data

  // everything revolves around that epic name
    $epicname         = $data->epicUserHandle;

  // solo stats
  if (isset($solo)){
    $solo_score       = $solo->score->valueInt;
    $solo_wins        = $solo->top1->valueInt;
    $solo_top3        = $solo->top3->valueInt;
    $solo_top10       = $solo->top10->valueInt;
    $solo_top25       = $solo->top25->valueInt;
    $solo_kd          = $solo->kd->valueDec;
    $solo_matches     = $solo->matches->valueInt;
    $solo_kills       = $solo->kills->valueInt;
    $solo_minutes     = $solo->minutesPlayed->valueInt;
    $solo_kpm         = $solo->kpm->valueDec;
    $solo_kpg         = $solo->kpg->valueDec;
    $solo_avgtime     = $solo->avgTimePlayed->valueDec;
    $solo_scorematch  = $solo->scorePerMatch->valueDec;
    $solo_scoremin    = $solo->scorePerMin->valueDec;
  }

  // duos stats
  if (isset($duos)){
    $duos_score       = $duos->score->valueInt;
    $duos_wins        = $duos->top1->valueInt;
    $duos_top3        = $duos->top3->valueInt;
    $duos_top10       = $duos->top10->valueInt;
    $duos_top25       = $duos->top25->valueInt;
    $duos_kd          = $duos->kd->valueDec;
    $duos_matches     = $duos->matches->valueInt;
    $duos_kills       = $duos->kills->valueInt;
    $duos_minutes     = $duos->minutesPlayed->valueInt;
    $duos_kpm         = $duos->kpm->valueDec;
    $duos_kpg         = $duos->kpg->valueDec;
    $duos_avgtime     = $duos->avgTimePlayed->valueDec;
    $duos_scorematch  = $duos->scorePerMatch->valueDec;
    $duos_scoremin    = $duos->scorePerMin->valueDec;
  }
  // squads stats
  if (isset($squads)){
    $squads_score       = $squads->score->valueInt;
    $squads_wins        = $squads->top1->valueInt;
    $squads_top3        = $squads->top3->valueInt;
    $squads_top10       = $squads->top10->valueInt;
    $squads_top25       = $squads->top25->valueInt;
    $squads_kd          = $squads->kd->valueDec;
    $squads_matches     = $squads->matches->valueInt;
    $squads_kills       = $squads->kills->valueInt;
    $squads_minutes     = $squads->minutesPlayed->valueInt;
    $squads_kpm         = $squads->kpm->valueDec;
    $squads_kpg         = $squads->kpg->valueDec;
    $squads_avgtime     = $squads->avgTimePlayed->valueDec;
    $squads_scorematch  = $squads->scorePerMatch->valueDec;
    $squads_scoremin    = $squads->scorePerMin->valueDec;
  }

  // what's my name bitch?
  if ($debugEnable == "true"){
    echo "Epic Username: " . $epicname . "\n";
  }

  // solos data
  if (isset($solo)){
    $aquery = "SELECT * FROM `solo.$platform` WHERE epicname = '$epicname'";
    if ($result = $conn->query($aquery)){
      $row_cnt = $result->num_rows;
      if ($row_cnt < 1){
        $dboperation = "Inserted";
        $bquery = "INSERT INTO `solo.$platform` (score, top1, top3, top10, top25, kd, matches, kills, minutesplayed, kpm, kpg, avgtime, scorematch, scoremin, epicname)".
                  "VALUES ($solo_score, $solo_wins, $solo_top3, $solo_top10, $solo_top25, $solo_kd, $solo_matches, $solo_kills, $solo_minutes, $solo_kpm, $solo_kpg, $solo_avgtime, $solo_scorematch, $solo_scoremin, '$epicname')";
      } else {
        $dboperation = "Updated";
        $bquery = "UPDATE `solo.$platform` SET score = $solo_score, top1 = '$solo_wins', top3 = '$solo_top3', top10 = '$solo_top10', top25 = '$solo_top25', kd = '$solo_kd', matches = '$solo_matches', kills = '$solo_kills', minutesplayed = '$solo_minutes', kpm = '$solo_kpm', kpg = '$solo_kpg', avgtime = '$solo_avgtime', scorematch = '$solo_scorematch', scoremin = '$solo_scoremin' WHERE epicname = '$epicname'";
      }
      if ($conn->query($bquery) === TRUE) {
        if ($debugEnable == "true"){
          print "Solo.$platform $dboperation successfully\n";
        }
      } else {
        if ($debugEnable == "true"){
          print "Solo.$platform $dboperation failed!\n";
          print "Error: " . $bquery . "\n" . $conn->error . "\n";
        }
      }
    }
  }

  //duos data
  if (isset($duos)){
    $aquery = "SELECT * FROM `duos.$platform` WHERE epicname = '$epicname'";
    if ($result = $conn->query($aquery)){
      $row_cnt = $result->num_rows;
      if ($row_cnt < 1){
        $dboperation = "Inserted";
        $bquery = "INSERT INTO `duos.$platform` (score, top1, top3, top10, top25, kd, matches, kills, minutesplayed, kpm, kpg, avgtime, scorematch, scoremin, epicname)".
                  "VALUES ($duos_score, $duos_wins, $duos_top3, $duos_top10, $duos_top25, $duos_kd, $duos_matches, $duos_kills, $duos_minutes, $duos_kpm, $duos_kpg, $duos_avgtime, $duos_scorematch, $duos_scoremin, '$epicname')";
      } else {
        $dboperation = "Updated";
        $bquery = "UPDATE `duos.$platform` SET score = $duos_score, top1 = '$duos_wins', top3 = '$duos_top3', top10 = '$duos_top10', top25 = '$duos_top25', kd = '$duos_kd', matches = '$duos_matches', kills = '$duos_kills', minutesplayed = '$duos_minutes', kpm = '$duos_kpm', kpg = '$duos_kpg', avgtime = '$duos_avgtime', scorematch = '$duos_scorematch', scoremin = '$duos_scoremin' WHERE epicname = '$epicname'";
      }
      if ($conn->query($bquery) === TRUE) {
        if ($debugEnable == "true"){
          print "duos.$platform $dboperation successfully\n";
        }
      } else {
        if ($debugEnable == "true"){
          print "duos.$platform $dboperation failed!\n";
          print "Error: " . $bquery . "\n" . $conn->error . "\n";
        }
      }
    }
  }

  //squads data
  if (isset($squads)){
    $aquery = "SELECT * FROM `squads.$platform` WHERE epicname = '$epicname'";
    if ($result = $conn->query($aquery)){
      $row_cnt = $result->num_rows;
      if ($row_cnt < 1){
        $dboperation = "Inserted";
        $bquery = "INSERT INTO `squads.$platform` (score, top1, top3, top10, top25, kd, matches, kills, minutesplayed, kpm, kpg, avgtime, scorematch, scoremin, epicname)".
                  "VALUES ($squads_score, $squads_wins, $squads_top3, $squads_top10, $squads_top25, $squads_kd, $squads_matches, $squads_kills, $squads_minutes, $squads_kpm, $squads_kpg, $squads_avgtime, $squads_scorematch, $squads_scoremin, '$epicname')";
      } else {
        $dboperation = "Updated";
        $bquery = "UPDATE `squads.$platform` SET score = $squads_score, top1 = '$squads_wins', top3 = '$squads_top3', top10 = '$squads_top10', top25 = '$squads_top25', kd = '$squads_kd', matches = '$squads_matches', kills = '$squads_kills', minutesplayed = '$squads_minutes', kpm = '$squads_kpm', kpg = '$squads_kpg', avgtime = '$squads_avgtime', scorematch = '$squads_scorematch', scoremin = '$squads_scoremin' WHERE epicname = '$epicname'";
      }
      if ($conn->query($bquery) === TRUE) {
        if ($debugEnable == "true"){
          print "squads.$platform $dboperation successfully\n";
        }
      } else {
        if ($debugEnable == "true"){
          print "squads.$platform $dboperation failed!\n";
          print "Error: " . $bquery . "\n" . $conn->error . "\n";
        }
      }
    }
  }
}
?>
