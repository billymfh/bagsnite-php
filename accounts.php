<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
    function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    }
    $(document).on('submit', '#UpdateForm', function() {
      $.post("components/accountupdate.php", $(this).serialize())

      .done(function(data){
        $("#dis").fadeIn('slow', function(){
            $("#dis").html('<div class="alert alert-info">'+data+'</div>');
            sleep(900).then(() => {
              $("#dis").fadeOut('slow');
            });
        });
      });
      return false;
    });
  });
  </script>
  <title>Account Names</title>
</head>
<body>

<?php
include "config.php";
include $basePath . $includesDir . "database.php";

session_start();

$google_userid = $_SESSION['google_userid'];

$query = "SELECT * FROM users WHERE google_userid = '$google_userid'";
if ($result = $conn->query($query)){
  $row_cnt = $result->num_rows;
  if ($row_cnt < 1){
    printf ("no results found... something bad happened\n");
  }
  else if ($row_cnt > 1){
    printf ("multiple hits... wtf\n");
  }
  else{
    $obj = $result->fetch_object();
    $epicname = $obj->epicname;
    $slackname = $obj->slackname;
    $psnname = $obj->psnname;
    $nickname = $obj->nickname;
    $result->close();
  }
}
?>

  <form method='post' id='UpdateForm' action='#'>
          <div id="epic-group" class="form-group">
              <label for="epicname">Epic Username</label>
              <input type="text" class="form-control" name="epicname" value="<?php echo $epicname;?>">
          </div>
          <div id="slack-group" class="form-group">
              <label for="slackname">Slack Username</label>
              <input type="text" class="form-control" name="slackname" value="<?php echo $slackname;?>">
          </div>
          <div id="psn-group" class="form-group">
              <label for="psnname">PSN Username</label>
              <input type="text" class="form-control" name="psnname" value="<?php echo $psnname;?>">
          </div>
          <div id="nick-group" class="form-group">
              <label for="nickname">Nickname</label>
              <input type="text" class="form-control" name="nickname" value="<?php echo $nickname;?>">
          </div>
          <div id="google_userid-group" class="form-group">
              <input type="hidden" value="<?php echo $google_userid; ?>" name="google_userid" />
          </div>
          <button type="submit" class="btn btn-success">Update<span class="fa fa-arrow-right"></span></button>
      </form>
      <br/>
      <a class="home" href="oauth.php">Return Home</a>
<div id="dis">
</div>
<?php
if ($debugEnable == "true"){
  echo "Google User ID is: " . $_SESSION['google_userid'];
}
?>

</body>
</html>
