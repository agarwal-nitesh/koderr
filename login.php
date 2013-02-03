<?php
session_start();
    if (($connection = mysql_connect("127.0.0.1", "root", "nightangle")) === false)
        die("Could not connect to database");

    if (mysql_select_db("lamp", $connection) === false)
        die("Could not select database");

    if (isset($_POST["user"]) && isset($_POST["pass"]))
    {
    	  
    	  $user=substr($_POST["user"], 0, 9);
    	  $user=mysql_real_escape_string($_POST["user"]);
    	  $pass=mysql_real_escape_string($_POST["pass"]);
        $sql = sprintf("SELECT name FROM userinfo WHERE ((user='%s' OR emailid='%s') AND pass='%s')",$user,$user,$pass);
        $result=mysql_query($sql);
        $row=mysql_fetch_array($result,MYSQL_BOTH);
        if ($result === false)
            die("Could not query database");
        
        if (mysql_num_rows($result) == 1)
        {
            $_SESSION["authenticated"] = true;
            $_SESSION["user"]=$user;
            $_SESSION["pass"]=$pass;
            $_SESSION["name"]=$row[0];
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: http://$host$path/home.php");
            exit;
        }
    }
?>

<!DOCTYPE html>

<html>
  <head>
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <script type="text/javascript" >
        window.onload=function(){
           var sql=document.getElementById('p1');
           var server=document.getElementById('p2');
           var os=document.getElementById('p3');
           var scrpt=document.getElementById('p4');
           var psql=document.getElementById('mysql');
           var pserver=document.getElementById('apache');
           var pos=document.getElementById('linux');
           var pscrpt=document.getElementById('php');
              
              sql.onmouseover=function(){
     	            sql.className+=' hover';
     	            server.className='roundabout';
     	            os.className='roundabout';
     	            scrpt.className='roundabout';
     	            pserver.style.display='none';
     	            pos.style.display='none';
     	            pscrpt.style.display='none';
     	            psql.style.display='block';}; 
    
     
             server.onmouseover=function(){
		            server.className+=' hover'; 
		            sql.className='roundabout';
		            os.className='roundabout';
		            scrpt.className='roundabout';
		            psql.style.display='none';
		            pos.style.display='none';
		            pscrpt.style.display='none';   	
                  pserver.style.display='block';};
      
     
             os.onmouseover=function(){
                  os.className+=' hover';
                  server.className=' roundabout';
                  sql.className=' roundabout';
                  scrpt.className='roundabout';     
                  psql.style.display='none';
                  pserver.style.display='none';
                  pscrpt.style.display='none';	
      	         pos.style.display='block';};

     
            scrpt.onmouseover=function(){
     	            scrpt.className+=' hover';
     	            server.className='roundabout';
     	            sql.className='roundabout';
     	            os.className='roundabout';
     	            psql.style.display='none';
     	            pserver.style.display='none';
     	            pos.style.display='none';
     	            pscrpt.style.display='block';};
     };
    </script>
  </head>
  <body>
    <noscript>turn on java script or site becomes ugly for you/// try to find your way around with off js</noscript>
    <div id="goodbye" class="roundabout-holder" style="position: absolute;">
<div id="p1" class="roundabout"  style="position: relative; left: 270px; top: 150px;"><img src="img/mysql.gif" /></div>
<div id="p2" class="roundabout"  style="position: relative; left: 100px;  top: 50px;"><img src="img/apache.jpg" /></div>
<div id="p3" class="roundabout"  style="position: relative; left: 270px; top: -10px;"><img src="img/tux.jpg" /></div>
<div id="p4" class="roundabout"  style="position: relative; left: 440px; top:-270px;"><img src="img/php.jpg" /></div>
</div>
  <div id="blackdawn">  
  <?php
  $dec=shell_exec("banner LAMP");
  echo "<pre>$dec</pre>";
  ?>
  </div>

<div id="paragraph">
<p id="linux" style="display: none">Linux was originally developed as a free operating system for Intel x86-based personal computers. It has since been ported to more computer hardware platforms than any other operating system. It is a leading operating system on servers and other big iron systems such as mainframe computers and supercomputers.The Android system in wide use on mobile devices is built on the Linux kernel.</p>
<p id="apache" style="display:none">The Apache HTTP Server, commonly referred to as Apache, is a web server software notable for playing a key role in the initial growth of the World Wide Web. Typically Apache is run on a Unix-like operating system.</p>
<p id="mysql" style="display:none">MySQL officially, but also called "My Sequel") is the world's most used open source relational database management system as of 2008 that runs as a server providing multi-user access to a number of databases.</p>
<p id="php" style="display:none">PHP is a general-purpose server-side scripting language originally designed for Web development to produce dynamic Web pages.A competitor to Microsoft's Active Server Pages (ASP) server-side script engine and similar languages, PHP is installed on more than 20 million Web sites and 1 million Web servers.</p>
</div>

  <div id="login">
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
      <table>
        <tr>
          <td>Username:</td>
          <td>
            <input name="user" type="text" value="roll no. or nitrkl.ac.in email" onfocus="this.value=''"></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input name="pass" type="password"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Log In"></td>
        </tr>
      </table>      
    </form>
    </br>
    <a href="registration.php";>SIGN UP HERE</a> 
    </div>
    </div>

<div id="testquestion">
<a href='contest.php' target='_blank'><h1>CONTEST QUESTION</h1	></a>
<h2>Do not forget to compile your file as soon as you upload it </h2>	
</div>
<div id="loggedin"> 
<?php
if($_SESSION["authenticated"])
{ 
print("you are logged in </br>");
echo "<a href='logout.php'>logout </a>";
echo "</br><a href='http://192.168.192.186/lampsite/home.php'>file uplosd status</a>";
}
else
{
echo "You are not logged in or registered <a href='login.php'>loginregister</a>";
echo "</br>go back to the<a href='http://192.168.192.186:8080'>front page</a>";	 
exit();
}
?>

  </body>
</html>
