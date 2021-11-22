<?php

// $host = '<yourservername>.mysql.database.azure.com';
// $username = '<yourusername>@<yourservername>';
// $password = '<yourpassword>';
// $db_name = 'testdb';
$host = '';
$username = '';
$password = '';
$db_name = '';
  
foreach ($_SERVER as $key => $value) {
  if (strpos($key, "MYSQLCONNSTR_") !== 0) {
      continue;
  }
  
  // $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
  // $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
  // $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
  // $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);

  $host = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
  $db_name = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
  $username = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
  $password = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

 echo "mysqlnd_azure.enableRedirect: ", ini_get("mysqlnd_azure.enableRedirect"), "\n<br />";
 echo "host: ", $host, " username: ", $username, " dbName: ", $db_name, "\n<br />";
 echo "\n<br />";
 
 $db = mysqli_init();
 //The connection must be configured with SSL for redirection test
 $link = mysqli_real_connect ($db, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);
 if (!$link) {
    die ('Connect error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error() . "\n");
 }
 else {
   echo $db->host_info, "\n"; //if redirection succeeds, the host_info will differ from the hostname you used used to connect
   $res = $db->query('SHOW TABLES;'); //test query with the connection
   print_r ($res);
   $db->close();
 }
?>