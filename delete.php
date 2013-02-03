<?php
session_start();?>
<!doctype html>
<html>
<head>
<title>delete</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" /> 
</head>
<body>

<div id="loggedin">
<?php
if($_SESSION["authenticated"])
{ 
print("you are logged in </br>");
echo "<a href='logout.php'>logout </a>";
}
else
{
echo "You are not logged in or registered <a href='login.php'>loginregister</a>";	 
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
 </body> 
</html>

<?php
if(!isset($_POST["delete"]))
{
 header("Location: http://192.168.192.186/");
 exit();
}
if (($connection = mysql_connect("127.0.0.1","root", "nightangle")) === false)
        die("Could not connect to database");

    if (mysql_select_db("lamp", $connection) === false)
        die("Could not select database");
    $temp=mysql_real_escape_string($_SESSION["user"]);
    $sql = sprintf("UPDATE userinfo set file=NULL, time=NULL WHERE emailid='%s' OR user='%s'",$temp,$temp);
    $result=mysql_query($sql);
    if(mysql_affected_rows()>=1)
    {
    	$_SESSION["file"]=null;
    	$_SESSION["time"]=null;
    	$temp=substr($temp,0,9);
    	 if(strlen($temp)==9){
    	$cmd=sprintf("rm /home/uploads/%s*",$temp);
    	$out=shell_exec($cmd);}
    header("Location: http://192.168.192.186/lampsite/home.php");
    }
    else {
    	echo "Could not delete: <a href='home.php'> go back</a> ";
    	
    	}
?>

