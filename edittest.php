<?php
session_start();
include("includes/include.php");
$id=$_GET["id"];
$reason=$_GET["reason"];
$authlevel=$_SESSION["authlevel"];
if($authlevel=="1")
 { 	print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";
 }
else
 {    if($reason=="drop") //удаление теста
      {      	$step=$_GET['step'];
      	if(! $step=='1')
      	{          {print "
          <div align='center' valign='middle'>
          <table align='center' valign='middle' cellpadding='7' winth='70%'>
          <tr class='tr'>
          <td colspan='2' align='center'>Действительно удалить тест? Все результаты по данному тесту так же будут удалены!</td>
          </tr>
          <tr class='tr'>
          <td align='center'><a href='glav.php?lnk=edittest&id=$id&reason=drop&step=1'>Да</a></td>
          <td align='center'><a href='glav.php?lnk=tests'>Нет</a></td>
          </tr>
          </table>
          </div>
          ";}
        }
        else
        {          mysql_query("DELETE FROM `gotov_test` WHERE `id` = '$id'") or die(mysql_error());
          mysql_query("DELETE FROM `stud_otvet` WHERE `id_tests` = '$id'") or die(mysql_error());
          print "<div align='center' valign='middle'>Тест удален!<br><a href='glav.php?lnk=glavnaya'>OK</a></div>";
        }
      }
    elseif($reason=="edit")  //редактирование теста
      {      	 $step=$_GET['step'];
      	 if($step=="")
      	 {         $getinfo=mysql_query("SELECT * FROM `gotov_test` WHERE `id` = '$id'");
         while($row=mysql_fetch_array($getinfo))
          {            $testname=$row[1];
            $testy=$row[2];
            $predmetid=$row[3];                                          //переписать, без смены предмета
          }
         $testarr=explode(";",$testy);
         {print "<br /><br /><br /><div align='center'>Редактирование теста</div><br />\n
                <table align='center' valign='middle' cellpadding='7' width='70%'>\n
                <form action='glav.php?lnk=edittest&id=$id&reason=edit&step=1&pid=$predmetid' method='post'>\n
                <tr class='tr'>\n
                <td align='right'>Название теста</td>\n
                <td align='left'><input name='tname' type='text' value='$testname'></td>\n
                </tr>\n
                <tr class='tr'>\n
                <td>Название включаемого раздела</td>\n
                <td align='center'>Кол-во вопросов</td>\n
                </tr>\n
                ";
                }
         $gettests=mysql_query("SELECT * FROM `tests` WHERE `id_predmet` = '$predmetid'");
         $i=0;
         $num=1;
         while($row1=mysql_fetch_array($gettests))
           {
             print "<tr class='tr' $styletr>\n";           	 $testid=$testarr[$i];  //айдишник из таблицы gotov_tests
           	 $testkol=$testarr[$i+1];
           	 $test_id=$row1[0];     //айдишник из таблицы tetst
           	 if($testid==$test_id)
           	   {           	   	 {print "
           	   	 <td>
           	   	 <input name='chekbox$num' type='checkbox' value='on' CHECKED>
           	   	 <input name='testid$num' type='hidden' value='$test_id'>
           	   	 <b>$row1[3]</b>
           	   	 </td>
           	   	 ";}
           	   }
           	 else
           	   {                 {print "
           	   	 <td>
           	   	 <input name='chekbox$num' type='checkbox' value='on'>
           	   	 <input name='testid$num' type='hidden' value='$test_id'>
           	   	 <b>$row1[3]</b>
           	   	 </td>
           	   	 ";}
           	   }
           	 $j=0;
           	   	 $getvoprosy=mysql_query("SELECT * FROM `text_test` WHERE `id_tests` = '$row1[0]'");
           	   	 while($row2=mysql_fetch_array($getvoprosy))
           	   	   {
           	   	   	 $j++;
           	   	   }
           	   	 {print "
           	   	 <td align='center'>
           	   	 <input id='$num' name='testnum$num' type='text' size='3' value='$testkol'>
           	   	 <a href=# onClick='javascript:max_value($j,$num)'>  Max: $j</a>
           	   	 </td>
           	   	 ";}
           	 print "</tr>\n";
           	 $i=$i+2;
           	 $num++;
           	 $id_pr=$row1[1];
           }
           $num=$num-1;
           {print "
           <tr class='tr'>
           <input name='idpred' type='hidden' value='$id_pr'>
           <input name='num' type='hidden' value='$num'>
           <input name='testname' type='hidden' value='$testname'>
           <td align='center' colspan='2'><input type='submit' value='Редактировать'></td>
           </tr>
           </form>
           </table>
           ";}
         }
         elseif($step=="1")
         {           $query="";           $num=$_POST["num"];
           $tname=$_POST["tname"];
           $idpred=$_POST["idpred"];
           $testname=$_POST["testname"]; //изначальное название теста
           $sravnenie=strcasecmp($tname,$testname);
           if($tname=="")
            {              print "<center><hr>Не введено название теста!<hr></center>\n";
              print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
            }
           else
            {               if(! $sravnenie==0)
                 {                  $getname=mysql_query("SELECT * FROM `gotov_test` WHERE `name` = '$tname'");
                  $err=mysql_num_rows($getname);
                  if(! $err==0)
                    {               	       print "<br /><br /><center><hr>Тест с таким названием уже существует!<hr></center>\n";
                       print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
                    }
                  else
                    {               	      for($i=1;$i<=$num;$i++)
               	       {               	       	 $check=$_POST["chekbox$i"];
               	       	 if($check=="on")
               	       	   {                             $test_id=$_POST["testid$i"];
                             $testnum=$_POST["testnum$i"];
                             if($testnum=="")
                               {                               	 print "<br /><br /><hr><div align='center'>Не указано кол-во включаемых вопросов!</div><hr>\n";
                               	 print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
                               	 break;
                               }
                             else
                               {                               	 $query.=$test_id.";".$testnum.";";
                               }
               	       	   }
               	       	 else
               	       	   {
               	       	   }
               	       }
               	      if($query=="")
               	       {               	       	 print "<br /><br /><hr><div align='center'>Не один предмет не выбран!</div><hr>\n";
                         print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
               	       }
               	      else
               	       {               	       	 mysql_query("UPDATE `gotov_test` SET `name` = '$tname', `testy` = '$query' WHERE `id` = '$id'");
               	       	 print "<br /><br /><hr><div align='center'>Редактирование успешно завершено</div><hr>\n";
               	       	 print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
               	       }
                    }
                 }
               else
                 {                   for($i=1;$i<=$num;$i++)
               	       {
               	       	 $check=$_POST["chekbox$i"];
               	       	 if($check=="on")
               	       	   {
                             $test_id=$_POST["testid$i"];
                             $testnum=$_POST["testnum$i"];
                             if($testnum=="")
                               {
                               	 print "<br /><br /><hr><div align='center'>Не указано кол-во включаемых вопросов!</div><hr>\n";
                               	 print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$idpred&reason=edit'>\n";
                               	 break;
                               }
                             else
                               {
                               	 $query.=$test_id.";".$testnum.";";
                               }
               	       	   }
               	       	 else
               	       	   {

               	       	   }
               	       }
               	      if($query=="")
               	       {
               	       	 print "<br /><br /><hr><div align='center'>Не один предмет не выбран!</div><hr>\n";
                         print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
               	       }
               	      else
               	       {
               	       	 mysql_query("UPDATE `gotov_test` SET `name` = '$tname', `testy` = '$query' WHERE `id` = '$id'");
               	       	 print "<br /><br /><hr><div align='center'>Редактирование успешно завершено</div><hr>\n";
               	       	 print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=edittest&id=$id&reason=edit'>\n";
               	       }
                 }
            }
         }
      }
 }
?>