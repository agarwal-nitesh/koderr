<?php
session_start();?>

<!doctype html>
<html>
  <head>
    <title>delete</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" /> 
  </head>
<body>

<?php
 /* function credentials() {
    $flag=1;
    if(!preg_match("/.+@nitrkl\.ac\.in$/",$_POST["email"])	|| strlen($_POST["email"])!=22){
      echo "must be a nitrkl.ac.in email address go back ";
      $flag=0;}
    if(strlen($_POST["password1"])<6){
      echo "must provide atleast 6 characters in the password field go back";
      $flag=0;}
    if($_POST["password1"]!= $_POST["password2"]){
      echo "must provide the same passwords in two fields go back";
      $flag=0;}
    if($_POST["agreement"]!="on"){
      echo("you must agree to terms and conditions go back");
      $flag=0;}
    if(strlen($_POST["name"])<3){
      echo "must provide atleast 3 characters in your name else add nit with a space";
      $flag=0;}
    if($flag==0) 
      exit();  } */
?>
 

 <div id="st">
 <?php   
//   credentials();
   
   if (($connection = mysql_connect("127.0.0.1","root", "nightangle")) === false)
     die("Could not connect to database");

   if (mysql_select_db("lamp", $connection) === false)
     die("Could not select database");
        
   $sql = sprintf("SELECT 1 FROM userinfo WHERE emailid='%s'",mysql_real_escape_string($_POST["email"]));
   $result = mysql_query($sql);

   if ($result === false)
     die("Could not query database");
   if (mysql_num_rows($result) == 1){
     echo "you have already registered, incase you forgot password send me an email at niteshagarwal1.618@gmail.com";  }
   else {
     $user=substr($_POST["email"], 0, 9);
     $user1=mysql_real_escape_string($user);
     $pass=mysql_real_escape_string($_POST["password1"]);
     $mai=mysql_real_escape_string($_POST["email"]);
     $name=mysql_real_escape_string($_POST["name"]);
     $sql1= sprintf("INSERT INTO userinfo(user,pass,emailid,name) VALUES('%s', '%s', '%s','%s')",$user1,$pass,$mai,$name);
     $result1 = mysql_query($sql1);
     if ($result1 === false)
       die("Could not query database");
     else{  
       $_SESSION["user"]=$user;
       $_SESSION["pass"]=$pass;
       $_SESSION["mail"]=$mai;
       $_SESSION["name"]=$name;
       $_SESSION["authenticated"]=true;
       echo "<a href='home.php' ><h1>CONTINUE</h1> </a>";  }}        
           	
?>
</div>


<div id="blackdawn">
  
<?php
  $cmd=sprintf("banner %s",$_SESSION["name"]);
  $dec=shell_exec($cmd);
  echo "<pre>$dec</pre>";
?>
</div>


<div style="position:absolute; right:10px;"> 

<?php $dec=shell_exec("/var/www/lampsite/extras/blackdawn.sh");
  echo "<pre>$dec</pre>";?>

</div>


<div id="loggedin">
<?php
  if($_SESSION["authenticated"])
    { 
    print("you are logged in </br>");
    echo "<a href='logout.php'>logout </a>";
    echo "</br>go back to the<a href='http://192.168.194.104:8080'>front page</a>";}
  else
  {
  echo "You are not logged in or registered <a href='login.php'>loginregister</a>";	
  echo "</br>go back to the<a href='http://192.168.194.104:8080'>front page</a>"; 
  exit();
  }
?>
</div>
</body> 
</html>
