<?php 
session_start();

    setcookie("user", "", time() - 3600);
    setcookie("pass", "", time() - 3600);

    setcookie(session_name(), "", time() - 3600);
    session_destroy();
    header("Location : http://192.168.192.186/lampsite/login.php");
?>

<!DOCTYPE html>

<html>
  <head>
    <title>Log Out</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" /> 
  </head>
  <body>
    <h1>You are logged out!</h1>
    <h3><a href="login.php">LOGIN AGAIN</a></a></h3>
  </body>
  <div id="blackdawn">
  <?php
  $cmd=sprintf("banner %s",$_SESSION["name"]);
  $dec=shell_exec($cmd);
  echo "<pre>$dec</pre>";
  ?>
  </div>
</html>
