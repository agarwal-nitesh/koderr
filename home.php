<?php session_start();
?>
<!doctype html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="style/style.css" /></link>
 <title><?php echo $_SESSION["user"]; ?></title>
</head>
<body>

<div id="loggedin">
<?php
if($_SESSION["authenticated"])
{ 
print("you are logged in </br>");
echo "<a href='logout.php'>logout </a>";
echo "</br>go back to the<a href='http://192.168.192.186:8080'>front page</a>";
}
else {
	echo "you are not logged in ";
	echo "<a href='login.php' >login/register</a>";
	echo "</br>go back to the<a href='http://192.168.192.186:8080'>front page</a>";
	exit();
	}
	?>
</div>

  <div id="blackdawn">
  <?php
  $cmd=sprintf("banner %s",$_SESSION["name"]);
  $dec=shell_exec($cmd);
  echo "<pre>$dec</pre>";
  ?>
  </div>
       
<?php
if (($connection = mysql_connect("127.0.0.1","root", "nightangle")) === false)
        die("Could not connect to database");

    if (mysql_select_db("lamp", $connection) === false)
        die("Could not select database");
    $temp=mysql_real_escape_string($_SESSION["user"]);
    $sql = sprintf("SELECT file, time FROM userinfo WHERE emailid='%s' OR user='%s'",$temp,$temp);
                 
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result, MYSQL_BOTH);  

        if ($result === false)
            die("Could not query database");
    if (substr($row["file"],0,9)==substr($_SESSION["user"],0,9))
    {
    	$_SESSION["file"]=$row["file"];
    	$_SESSION["time"]=$row["time"];
      $prnt=sprintf("You have last uploaded a file  at %s which is saved as %s on server",$row["time"],$row["file"]);
      echo "<div id='uploadflag'>".$prnt."</div>";
      echo "</br><a href='filecontents.php' target='_blank'>see contents of your file</a>"; 
      echo "</br><a href='compiler.php' target='_blank'>check your output</a>";
      $registercont=file_get_contents("/var/www/lampsite/extras/home.txt");
      echo $registercont;
      
    	}
    	else {
    		$prnt=sprintf("No file uploaded"); 
      echo "<div id='uploadflag'>".$prnt."</div>";
    		$homecont=file_get_contents("/var/www/lampsite/extras/register.txt");
    		echo $homecont;
    		}
	
?>
</body>
</html>
