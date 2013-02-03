<!doctype html>
<html>
<head>
<title>compiler</title>
</head>
<body>
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
?>
<?php
    echo $row["file"];
    $user=substr($row["file"],0,9);
    $len=strlen($row["file"])-10;
    $lang=substr($row["file"],10,$len);
    



    if($lang=="cpp")
      {
         $cmd=sprintf("/var/www/lampsite/extras/cpp.sh %s %s",$user,$row["file"]);
         $out=shell_exec($cmd);
      }
    else if($lang=="c")
      {
        $cmd=sprintf("/var/www/lampsite/extras/c.sh %s %s",$user,$row["file"]);
    	$out=shell_exec($cmd);
      }
    else if($lang=="py")
      {
    	$cmd=sprintf("/var/www/lampsite/extras/python.sh %s",$row["file"]);
    	$out= shell_exec($cmd);
      }
    else if($lang=="java") 
      {
  	$cmd=sprintf("/var/www/lampsite/extras/java.sh %s",$user,$row["file"]);
    	$out=shell_exec($cmd);
      }
    elseif($lang=="cs") 
      {
      	$tre=$user.".exe";
      	$cmd=sprintf("/var/www/lampsite/extras/cs.sh %s %s",$row["file"],$tre);
	$out=shell_exec($cmd);      	
      }
    

    if($out==""){
      echo "  Your program has errors, only use standard libraries for any language";}
    else{
      $oex=sprintf("/var/www/lampsite/extras/copy.sh %s",$row["file"]);
      $ex=shell_exec($oex);
      $str = str_replace(array("\r\n", "\r", "\n"), ' ', $out);
      $cm=sprintf("/var/www/lampsite/extras/correx.sh %s",$str);
      $exe=shell_exec($cm);	}
      echo "<pre>$out</pre>";
         
         
?>
</body>
</html>
