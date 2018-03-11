<?php
# Used as an include
# This is just used to set up our mysqli object/connection for a mysql mysql database
# also note that this is super specific to Azure MySQL Databases because that's what I'm using,
# hence the SSL cert.
# for other non-azure databases, this will need to be modified.

// Create connection
$conn = mysqli_init();
mysqli_ssl_set($conn,NULL,NULL, $basePath . $includesDir ."BaltimoreCyberTrustRoot.crt.pem", NULL, NULL) ;
mysqli_real_connect($conn, $mysqlServer, $mysqlUser, $mysqlPassword, $mysqlDatabase, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
