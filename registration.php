<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
     <script>

        function validate()
        {
        	  if (!document.forms.registration.email.value.match(/.+@nitrkl\.ac\.in$/) || document.forms.registration.email.value.length!=22)
            {
                alert("You must provide nitrkl.ac.in email adddress.");
                return false;
            }
            
            else if (document.forms.registration.password1.value == "" || document.forms.registration.password1.value.length < 6)
            {
                alert("You must provide a password with atleast 6 characters");
                return false;
            }
            else if (document.forms.registration.password1.value != document.forms.registration.password2.value)
            {
                alert("You must provide the same password twice.");
                return false;
            }
            else if (document.forms.registration.name.value=="" || document.forms.registration.name.value.length < 3)
            {
                alert("We expect that your full name will be atleast 3 characters long if not add nit with a space");
                return false;
            }
            else if (!document.forms.registration.agreement.checked)
            {
                alert("You must agree to our terms and conditions.");
                return false;
            }
            return true;
        }

    </script>
    <title></title>
  </head>
  <body>
  
<div id="loggedin">
<?php
if($_SESSION["authenticated"])
{ 
print("you are logged in </br>");
echo "<a href='logout.php'>logout </a>";
echo "</br>go back to the<a href='http://192.168.194.104:8080'>front page</a>";
}
else
{
echo "You are not logged in or registered <a href='login.php'>loginregister</a>";	 
echo "</br>go back to the<a href='http://192.168.192.186:8080'>front page</a>";
}
?>
</div>
  <div id="blackdawn">
  <?php
    //include(header.php);
    //$obj= new header();
    //obj.asciiart("LINUX APACHE MYSQL PHP PYTHON");
    $dec=shell_exec("banner LINUX APACHE MYSQL PHP PYTHON");
    echo "<pre>$dec</pre>";
  ?>
  </div>
    <div id="st">
    <strong>Do not forget your password, <br /> if you do, you will have to mail me at niteshagarwal1.618@gmail.com <br /> and then wait for my response.</strong></br></br>    
    <form action="process.php" method="post" name="registration" onsubmit="return validate();">
    <table>
      <tr><td>Name:</td><td><input maxlength="55" name="name" type="text"></td></tr>
      <tr><td>Email: (nitrkl.ac.in only)</td><td><input maxlength=22 name="email" type="text"></td></tr>
      
      <tr><td>Password:</td> <td><input maxlength=20 name="password1" type="password"></td></tr>
  
      <tr><td>Password (again):</td> <td><input maxlength=20 name="password2" type="password"></td></tr>
      
      <td><a href="termsandconditions.html" target="_blank"> I agree to terms and conditions</a> </td> <td><input name="agreement" type="checkbox"></td></tr>
      
      <tr><td><input type="submit" value="Submit"></td></tr>
      </table>
    </form>
    </div>
  </body>
</html>
