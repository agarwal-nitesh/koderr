<?php
session_start();
if (($connection = mysql_connect("127.0.0.1","root", "nightangle")) === false)
        die("Could not connect to database");

    if (mysql_select_db("lamp", $connection) === false)
        die("Could not select database");
    $temp=mysql_real_escape_string($_SESSION["user"]);
?>		
<!doctype html>
<html>
  <head>
    <title>trigger</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" /> 
  </head>
<body>

<div id="loggedin">
<?php
if($_SESSION["authenticated"])
{ 
print("you are logged in </br>");
echo "<a href='logout.php'>logout </a>";
echo "go back to the<a href='http://192.168.194.104:8080'>front page</a>";
}
else
{
echo "You are not logged in or registered <a href='login.php'>loginregister</a>";
echo "go back to the<a href='http://192.168.194.104:8080'>front page</a>";	 
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
function get_extension($file_name){
	    $ext = explode('.', $file_name);
	    $ext = array_pop($ext);
	    return strtolower($ext);	}
	    
function exit_status($str){
	    echo json_encode(array('status'=>$str));
	    exit;
	}


$file_name=$_FILES[lamp][name];

$upload_dir='/home/uploads/';

$allowed_ext=array('txt');



if(!in_array(get_extension($file_name),$allowed_ext)) 
  {
  	echo "<a href='home.php' >home </br></br>	</a>";
  	exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
  }   

$tmp_name=$_FILES[lamp][tmp_name];

$file_name=substr($_SESSION["user"],0,9).".".$_POST["language_used"];
$destination=$upload_dir.$file_name;

?>
<div id="st">
<?php
if(move_uploaded_file($tmp_name,$destination)) 
  {
  	$c=sprintf("chmod 777 /home/uploads/%s",$file_name);
  	$t=shell_exec("$c");
  $_SESSION["file"]=$file_name;
  $_SESSION["time"]=$time;
  $time=strftime('%H%M%S');
  $sql1=sprintf("UPDATE userinfo SET file='%s' WHERE user='%s' OR emailid='%s'",$file_name,$temp,$temp);
  $sql2=sprintf("UPDATE userinfo SET time='%s' WHERE user='%s' OR emailid='%s'",$time,$temp,$temp);
  $result1 = mysql_query($sql1);
  $result2 = mysql_query($sql2);
  echo "file uploaded</br></br> GOTO ";
  echo "<a href='home.php' >homepage </a>";
  }

?>
</div>
</body>
</html>
