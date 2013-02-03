<html>
<head>
<title>contents</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<?php
session_start();
if (($connection = mysql_connect("127.0.0.1","root", "nightangle")) === false)
        die("Could not connect to database");

    if (mysql_select_db("lamp", $connection) === false)
        die("Could not select database");
    $temp=mysql_real_escape_string($_SESSION["user"]);
    $sql = sprintf("SELECT file FROM userinfo WHERE emailid='%s' OR user='%s'",$temp,$temp);
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result, MYSQL_BOTH);  

        if ($result === false)
            die("Could not query database");

$cmd=sprintf("cat /home/uploads/%s",$row["file"]);
$contents=shell_exec($cmd);
echo "<pre>$contents</pre>";
?>
