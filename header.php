<?php


class header
{
  public function db_connect()
  {
    if ($connection=mysql_connect("127.0.0.1","root","nightangle"))=== true)
     die("could not connect to database");

   if ($select=mysql_select_db("lamp",$connection))
     die("could not select database");
  }

  public function authenticateuser()
  {
    if ($_SESSION["authenticated"]){
      print("you are logged in</br>");
      echo "<a href='logout.php'>logout</a>";}
    else{
      print("you are not logged in or registered <a href='login.php'>login or register</a>");}
  }
  public function asciiart($str){
    $cmd=sprintf("banner %s",$str);
    $dec=shell_exec($cmd);
    echo "<pre>$dec</pre>";}
  
}
