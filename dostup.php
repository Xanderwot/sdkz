<?php
session_start();
include("includes/include.php");$auth=$_SESSION['id'];
$step=$_GET['step'];

if($step==1)
{  $uid=$_GET['id'];
  $q=mysql_query("SELECT * FROM `gotov_test`");
  print "<br /><br /><center>Выберите тест, по названию, из списка для выдачи допуска</center><br /><br />";  {
  print "<table align='center' valign='midle' cellpaddind='7' width='70%'>
  <tr class='tr'> \n
  <td align='center'>Название теста</td>\n
  <td align='center'>Предмет</td>\n
  <td align='center'>Автор составитель</td>\n
  </tr>\n";
  }
  while($row=mysql_fetch_array($q))    {
      $pid=$row[3];
      $author=$row[4];
      $getpredmet=mysql_query("SELECT * FROM `predmet` WHERE `id` = '$pid'");
      $getauthor=mysql_query("SELECT * FROM `users` WHERE `id` = '$author'");
      while($row1=mysql_fetch_array($getpredmet))
       {       	 $predmetname=$row1[1];
       	 $predmetname=ucfirst($predmetname);
       }
      while($row2=mysql_fetch_array($getauthor))
       {       	 $authorname=$row2[4];
       }
      {print "
      <tr class='tr' $styletr> \n      <td align='center'><a href='glav.php?lnk=dostup&uid=$uid&gtid=$row[0]&step=2'>$row[1]</a></td> \n      <td align='center'>$predmetname</td> \n
      <td align='center'><a href='glav.php?lnk=user&uid=$author'>$authorname</a></td> \n
      </tr> \n
      ";}
    }
  print "</table>";
}
elseif($step==2)
{   $uid=$_GET['uid'];
   $gtid=$_GET['gtid'];
   mysql_query("INSERT INTO `dostup` VALUES ('$uid', '$gtid', '', '$auth')") or die("<br /><br /><br /><hr><div align='center'>Пользователь уже допущен к данному тесту</div><hr>");

   print "<br /><br /><br /><hr><div align='center'>Допуск выдан</div><hr>";
}
else
{
{print "
<br /><br />
<center>Список допущенных к тестированию:</center><br /><br /><br />
";}
$q=mysql_query("SELECT * FROM `dostup`");
$error=mysql_num_rows($q);
if ($error==0)
 {   print "<center><hr>Список допущеных пуст.<hr></center>";
 }
else
 {   $css="class='shapka'";   {print "
    <table align='center' valign='midle' cellpaddind='7' width='70%'>\n    <tr $css>\n    <td><center>Ф.И. студента</center></td>\n    <td><center>Группа</center></td>\n    <td><center>Допущен к тесту</center></td>\n
    <td align='center'>Предмет</td>\n
    <td align='center'>Допуск выдал</td>\n    </tr>    ";}   while($row=mysql_fetch_array($q))
     {       $uid=$row[0];       $tid=$row[1];
       $kto=$row[3];
       $q1=mysql_query("SELECT * FROM `gotov_test` WHERE `id` = '$tid'");
       while($row1=mysql_fetch_array($q1))
         {           $tname=$row1[1];           $pid=$row1[3];
         }
       $q1=mysql_query("SELECT * FROM `users` WHERE `id` = '$uid'");       while($row1=mysql_fetch_array($q1))         {
           $uname=$row1[3];
           $ufname=$row1[4];
           $grp=$row1[5];
         }
       $getpredmet=mysql_query("SELECT * FROM `predmet` WHERE `id` = '$pid'");
       while($row2=mysql_fetch_array($getpredmet))
         {           $predmet=$row2[1];
           $predmet=ucfirst($predmet);
         }
       $getkto=mysql_query("SELECT * FROM `users` WHERE `id`='$kto'");
       while($row3=mysql_fetch_array($getkto))
         {           $authorname=$row3[4];
         }
       {print "
       <tr $css>\n       <td><center>$ufname $uname</center></td>\n       <td><center>$grp</center></td>\n       <td><center>$tname</center></td>\n
       <td align='center'>$predmet</td>\n
       <td align='center'><a href='glav.php?lnk=user&uid=$kto'>$authorname</a></td>\n       </tr>
       ";}
     }
     }
   print "</table>";
   print "<br /><br /><center>Выдача доступа для студента</center><br />";
   print"<center>Введите ID пользователя: <input id='input_id' name='Name' onKeyUp='javascript:searchNameq()' onClick='javascript:searchNameq()' type='text' value=''></center>";
   print "<div id='div_id'></div>";
}
?>