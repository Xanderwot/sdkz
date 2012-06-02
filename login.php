<?php
session_start();
if(! $_SESSION['id']=="")
{  header('location: glav.php');
}
else
{
include("config.php");
$st=$_GET['st'];
if ($st=='login')
{  $ulog=$_POST['ulog'];
  $upass=$_POST['upass'];
  $ulog=strtolower($ulog);
  $upass=md5($upass);
  if ($ulog=='')
   {   	 $page="<html>\n";
     $page.="<head>\n";
     $page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
     $page.="<title>TestProg</title>\n";
     $page.="</head>\n";
     $page.="<body>\n";   	 $page.="<div id='done'>\n";
   	 $page.="Все поля обязательны к заполнению.<br>\n";
   	 $page.="<a href='login.php'>Назад</a>\n";
   	 $page.="</div>\n";
   	 $page.="</body>\n";
     $page.="</html>\n";
   }
  elseif ($upass=='')
   {   	 $page="<html>\n";
     $page.="<head>\n";
     $page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
     $page.="<title>TestProg</title>\n";
     $page.="</head>\n";
     $page.="<body>\n";
   	 $page.="<div id='done'>\n";
   	 $page.="Все поля обязательны к заполнению.<br>\n";
   	 $page.="<u><a href='login.php'>Назад</a></u>\n";
   	 $page.="</div>\n";
   	 $page.="</body>\n";
     $page.="</html>\n";
   }
  else
   {   	 $login=mysql_query("SELECT * FROM `users` WHERE `mail` = '$ulog'");
   	 $auth_f=mysql_num_rows($login);
   	 if ($auth_f==0)
   	   {   	   	 $page="<html>\n";
         $page.="<head>\n";
         $page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
         $page.="<title>TestProg</title>\n";
         $page.="</head>\n";
         $page.="<body>\n";
   	     $page.="<div id='done'>\n";
   	     $page.="Логин или пароль не верны.<br>\n";
   	     $page.="<a href='login.php'>Назад</a>\n";
   	     $page.="</div>";
   	     $page.="</body>\n";
         $page.="</html>\n";
   	   }
   	 else
   	   {   	   	 while($row=mysql_fetch_array($login))
   	   	   {   	   	   	 $usdata['id']=$row[0];
    	     $usdata['umail']=$row[1];
    	     $usdata['upass']=$row[2];
    	     $usdata['authlevel']=$row[6];
    	     if ($usdata['umail']==$ulog)
    	      {
    		    if ($usdata['upass']==$upass)
    		     {
    		       $_SESSION['id']=$usdata['id'];
    		       $_SESSION['authlevel']=$usdata['authlevel'];
    		       $_SESSION['login']=true;
    		       $page="<html>\n";
                   $page.="<head>\n";
                   $page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
                   $page.="<title>TestProg</title>\n";
                   $page.="</head>\n";
                   $page.="<body>\n";
   	               $page.="<div id='done'>\n";
   	               $page.="Вход выполнен успешно.<br>\n";
   	               $page.="<a href='glav.php'>Далее</a>\n";
   	               $page.="</div>";
   	               $page.="</body>\n";
                   $page.="</html>\n";
    		     }
    		    else
    		     {
    		       $page="<html>\n";
                   $page.="<head>\n";
                   $page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
                   $page.="<title>TestProg</title>\n";
                   $page.="</head>\n";
                   $page.="<body>\n";
   	               $page.="<div id='done'>\n";
   	               $page.="Логин или пароль не верны.<br>\n";
   	               $page.="<a href='login.php'>Назад</a>\n";
   	               $page.="</div>";
   	               $page.="</body>\n";
                   $page.="</html>\n";
    		     }
    		  }
    	    else
    	      {
    	           $page="<html>\n";
                   $page.="<head>\n";
                   $page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
                   $page.="<title>TestProg</title>\n";
                   $page.="</head>\n";
                   $page.="<body>\n";
   	               $page.="<div id='done'>\n";
   	               $page.="Логин или пароль не верны.<br>\n";
   	               $page.="<a href='login.php'>Назад</a>\n";
   	               $page.="</div>\n";
   	               $page.="</body>\n";
                   $page.="</html>\n";
    		  }
           }
       }
   }
}
else
{
$page="<html>\n";
$page.="<head>\n";
$page.="<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
$page.="<script language='javascript' src='scripts/script.js'></script>\n";
$page.="<title>TestProg</title>\n";
$page.="</head>\n";
$page.="<body>\n";

$page.="<div id='rus'></div>\n";
$page.="<div id='login_text' align='center'>\n";
$page.="Логин:<br />Пароль:";
$page.="</div>\n";
$page.="<div id='login_inpt' align='center'>\n";
$page.="<form action='login.php?st=login' method='post'>\n";
$page.="<input id='log' name='ulog' type='text' value='' onKeyUp='javascript:KeyEvent()' onKeyDown='javascript:testing()'>\n";

$page.="<span id='err_login'></span><br />\n";
$page.="<input id='pas' name='upass' type='password' value='' onKeyDown='javascript:KeyEvent()' onKeyUp='javascript:KeyEvent()'>\n";
$page.="<span id='login_err'></span><br />\n";
$page.="<div id='inpb'><input type='submit' value='Вход' DISABLED></div>\n";

$page.="</form>\n";
$page.="</div>\n";

$page.="<div id='poloska'>";
$page.="Для получения доступа обращаться по адресу: <a href='mailto:studentbteu@mail.ru?subject=I_want_account'>studentbteu@mail.ru</a>";
$page.="</div>";
$page.="</body>\n";
$page.="</html>\n";
}
print $page;
}
?>