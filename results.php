<?php
session_start();
include("includes/include.php");
//error_reporting(0);
$authlevel=$_SESSION['authlevel'];
$iduser=$_SESSION['id'];
if($authlevel==1)
{	$getnumtests=mysql_query("SELECT * FROM `stud_otvet` WHERE `id_users` = '$iduser' GROUP BY `data`");
	$noneresults=mysql_num_rows($getnumtests);
	if($noneresults == 0)
	  {	    print "<br /><br /><br /><hr><div align='center'>Вы еще не проходили тестирование</div><hr>";
	  }
	else
      {      	print "<br /><br /><br /><table align='center' valign='midle' cellpadding='7' width='70%'> \n";       
	  while($row=mysql_fetch_array($getnumtests))
          {          	$del_test=false;
            $vsego=0;
            $pravilno=0;
            $gtid=$row[2];
            $data=$row[5];
            $q1=mysql_query("SELECT * FROM `stud_otvet` WHERE `id_users` = '$iduser' AND `data` = '$data'");
            while($row1=mysql_fetch_array($q1))     //сверяем ответы
              {
   	            $tid=$row1[3];
                $sotvet=$row1[4];
                $q3=mysql_query("SELECT * FROM `text_test` WHERE `id` = '$tid'");
                while($row3=mysql_fetch_array($q3))
                   {
   	   	             $potvet=$row3[4];
                     if($potvet==$sotvet)
                        {
   	   	                   $pravilno++;
                           $vsego++;
                        }
                     else
                        {
                          //print "$potvet   $sotvet <br />";
   	   	                  $vsego++;
                        }
                   }
              }
            if($vsego==0)
               {
   	             $del_test=true;
               }
            else
               {
                  $proc=$pravilno/$vsego;
                  $proc=$proc*100;
                  $proc=round($proc);
               }
            if($proc<60)
               {
                  $proc_text="<font color='red'>".$proc."%</font>";
               }
            elseif($del_test)
               {
                  $proc_text="<font color='red'>Тест был удален</font>";
               }
            else
               {
                  $proc_text="<font color='#00FF00'>".$proc."%</font>";
               }
            $q2=mysql_query("SELECT * FROM `users` WHERE `id` = '$iduser'");
            while($row2=mysql_fetch_array($q2))          //вывод имени студента  и группы
               {
                 {print "
                   <tr class='tr'  $styletr>
                   <td><center>$row2[4] $row2[3]</center></td>
                   <td><center>$row2[5]</center></td>
                 ";}
               }
            $q4=mysql_query("SELECT * FROM `gotov_test` WHERE `id` = '$gtid'");
            while($row4=mysql_fetch_array($q4))
               {
                  print"<td><center>$row4[1]</center></td>";
               }
            print "<td><center>$data</center></td>";
            print "<td><center>$proc_text</center></td>";
            print "</tr>";
          }
          print "</table>";
      }
}else
{
$q=mysql_query("SELECT * FROM `stud_otvet` GROUP BY `data`");
print "<br /><br /><br /><table align='center' valign='midle' cellpadding='7' width='70%'> \n";
$error=mysql_num_rows($q);
if($error==0)
{   {print "
     <tr class='shapka'>
     <td><center>Еще нет результатов тестирования</center></td>
     </td>
     </table>
   ";}
}
else
{
{print "
<tr class='shapka'>
<td><center>Студент</center></td>
<td><center>Группа</center></td>
<td><center>Название теста</center></td>
<td><center>Дата</center></td>
<td><center>Правильных ответов</center></td>
</tr>
";}
while($row=mysql_fetch_array($q))
 {
   $del_test=false;   $vsego=0;
   $pravilno=0;   $uid=$row[1];
   $gtid=$row[2];
   $data=$row[5];
   $q1=mysql_query("SELECT * FROM `stud_otvet` WHERE `id_users` = '$uid' AND `data` = '$data'");
   while($row1=mysql_fetch_array($q1))     //сверяем ответы
   {   	 $tid=$row1[3];
   	 $sotvet=$row1[4];
   	 $q3=mysql_query("SELECT * FROM `text_test` WHERE `id` = '$tid'");
   	 while($row3=mysql_fetch_array($q3))
   	   {   	   	  $potvet=$row3[4];
   	   	  if($potvet==$sotvet)
   	   	    {   	   	         	   	      
			  $pravilno++;
   	   	      $vsego++;
   	   	    }
   	   	  else           
      		{
   	   	      $vsego++;
   	   	    }
   	   }
   }
   if($vsego==0)
   {   	 $del_test=true;
   }
   else
   {   $proc=$pravilno/$vsego;
   $proc=$proc*100;
   $proc=round($proc);
   }
   if($proc<60)
    {      $proc_text="<font color='red'>".$proc."%</font>";
    }
   elseif($del_test)
    {      $proc_text="<font color='red'>Тест был удален</font>";
    }
   else
    {      $proc_text="<font color='#00FF00'>".$proc."%</font>";
    }
   $q2=mysql_query("SELECT * FROM `users` WHERE `id` = '$uid'");
   while($row2=mysql_fetch_array($q2))          //вывод имени студента  и группы
    {      {print "
      <tr class='tr'  $styletr>
      <td><center>$row2[4] $row2[3]</center></td>
      <td><center>$row2[5]</center></td>
      ";}
    }
   $q4=mysql_query("SELECT * FROM `gotov_test` WHERE `id` = '$gtid'");
   while($row4=mysql_fetch_array($q4))
   {
     print"<td><center>$row4[1]</center></td>";
   }
   print "<td><center>$data</center></td>";
   print "<td><center>$proc_text</center></td>";
   print "</tr>";
 }
 print "</table>";
}
}
?>

</body>

</html>