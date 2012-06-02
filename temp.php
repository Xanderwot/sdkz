<?php
header("Content-Type: text/html;charset=windows-1251");
?>
<html>

<head>
  <title></title>
</head>

<body>

<?php include("includes/include.php");
$id=$_GET['id'];
include("config.php");
{print "
<table align='center' valign='middle' cellpadding='7' width='70%'>
<tr class='shapka'>
   <td><center>ID</center></td>
   <td><center>Имя</center></td>
   <td><center>Фамилия</center></td>
   <td><center>Группа</center></td>
   <td></td>
   </tr>
";}
$q=mysql_query("SELECT * FROM `users` WHERE `id` LIKE '%$id%' ");
$error=mysql_num_rows($q);
if ($error==0)
{  print "<tr class='shapka'><td colspan='5'><center>Нет пользователя с таким ID</center></td></tr>";
}
else
{
while($row=mysql_fetch_array($q))
  {     {print "
     <tr class='tr' $styletr>
     <td><center>$row[0]</center></td>
     <td><center>$row[3]</center></td>
     <td><center>$row[4]</center></td>
     <td><center>$row[5]</center></td>
     <td><center><a href='glav.php?lnk=dostup&step=1&id=$row[0]'>Выбрать</a></center></td>
     </tr>
     ";}
   }
  print "</table>";
  }
?>

</body>

</html>