<?php
session_start();include("includes/include.php");
$uid=$_SESSION['id'];
$authlevel=$_SESSION['authlevel'];
if ($authlevel=="1")   //доступ к готовым тестам только для студентов, не забыть создать таблицу доступа
 {    print "<meta http-equiv='refresh' content='0; url=glav.php?lnk=testirovanie'>\n";
 }
else    //доступ для преподавателей и администраторов
 {   $reason=$_GET['reason'];
   $tid=$_GET['tid'];  if ($reason=="view") //просмотр теста
     {      print "<br /><hr><center>Редактирование в данном режиме не возможно. Для редактирования раздела пройдите по ссылке &laquo;редактировать&raquo; внизу страницы.</center><hr><br /><br />";      $q=mysql_query("SELECT * FROM `tests` WHERE `id` = '$tid'");
      while($row=mysql_fetch_array($q))
        {         $pid=$row[1];
         $uid=$row[2];
         $tname=$row[3];
        }
      $q1=mysql_query("SELECT * FROM `users` WHERE `id` = '$uid'");
      while($row1=mysql_fetch_array($q1))
        {         $ufname=$row1[4];
        }
      $q2=mysql_query("SELECT * FROM `predmet` WHERE `id` = '$pid'");
      while($row2=mysql_fetch_array($q2))
        {         $predmet=$row2[1];
        }
      print "<table align='center' valign='midle' cellpaddind='7' width='70%'>\n";
      print "<tr class='shapka'>\n";
      print "<td><center>Название раздела</center></td>\n";
      print "<td><center>$tname</center></td>\n";
      print "</tr>\n";
      print "<tr class='shapka'>\n";
      print "<td><center>Предмет</center></td>\n";
      print "<td><center>$predmet</center></td>\n";
      print "</tr>\n";
      print "<tr class='shapka'>\n";
      print "<td><center>Автор</center></td>\n";
      print "<td><center>$ufname</center></td>\n";
      print "</tr>\n";
      print "<form name=\"\" action=\"\" method=\"post\">\n";
      $q3=mysql_query("SELECT * FROM `text_test` WHERE `id_tests` = '$tid'");
      $j=1;
      $css="class='efect1'";
      while($row3=mysql_fetch_array($q3))
        {         if ($css=="class='efect2'")
         {
         	$css="class='efect1'";
         }
         else
         {
         	$css="class='efect2'";
         }         $ttext=$row3[2];
         $totvet=$row3[3];
         $otvet=$row3[4];
         print "<tr $css><td colspan='2'><center><b>Вопрос $j:</b></center></td></tr>";
         print "<tr $css >\n";
         $temp="<td><center>Текст вопроса:</center></td>\n";
         print "$temp";
         $ttext=nl2br($ttext);
         print "<td><textarea class='text' name='ttext$j' rows=5 cols=50 wrap='on'>$ttext</textarea></td>\n";
         print "</tr>\n";
         $n=0;
         $n2=strlen($otvet);
         $n3=0;
         for($i=0;$i<=$n2;$i++)
           {
            $n1=strpos($otvet,',',$n);
            if (! $n1)
              {          	    $n3++;
          	    $notvet[$i]=substr($otvet,$n2-1,1);
          	    break;              }
            else
              {              	$n3++;                              //Количество правильных ответов
              	$notvet[$i]=substr($otvet,$n1-1,1);
              	$n=$n1+1;
              }
           }
         $x=0;
         $n=0;
         $n2=strlen($totvet);
         for($i=0;$i<=$n2;$i++)
         {           $n1=strpos($totvet,')',$n);
           $n11=strpos($totvet,';',$n);
           if (! $n1)
             {               break;
             }
           else
             {             	$x++;           //количество вариантов ответов
             	$otvetnomer[$i]=substr($totvet,$n1-1,1);
             	$n111=$n11-$n1-1;
             	$otvettext[$i]=substr($totvet,$n1+1,$n111);
             	$n=$n11+1;
             }
         }
         $page="";
         if ($n3==1)
          {            for($i=0;$i<$x;$i++)
              {                $numotv=$otvetnomer[$i];
                $otvetstr=$otvettext[$i];
                $pravilno=$notvet[0];
                if($notvet[0]==$otvetnomer[$i])
                  {                  	$page .="<input name='otvet$j' type='radio' value='$i' checked>\n" ;
                  	$page .="$otvettext[$i]<br />\n";
                  }
                else
                  {                  	$page .="<input name='otvet$j' type='radio' value='$i'>\n";
                  	$page .="$otvettext[$i]<br />\n";
                  }
              }
          }
          else
            {             for($i=0;$i<$x;$i++)	  //переставить местами и сравнить нормально))
             {
             $numotv=$otvetnomer[$i];
             $otvetstr=$otvettext[$i];
                for($j1=0;$j1<$n3;$j1++)
                  {
                   $pravilno=$notvet[$j1];
                   if($notvet[$j1]==$otvetnomer[$i])
                     {
                  	  $uslov=true;
                  	  break;
                     }
                   else
                     {                       $uslov=false;
                     }
                  }
             if($uslov)
               {               	$page .="<input name='otvetvar$j' type='checkbox' value='$i' checked> \n";
               	$page .="$otvettext[$i]<br />\n";
               }
             else
               {               	$page .="<input name='otvetvar$j' type='checkbox' value='$i'> \n";
               	$page .="$otvettext[$i]<br />\n";
               }
             }
             }
         print "<tr $css >\n";
         print "<td><center>Варианты ответа</center></td>\n";
         print "<td>$page</td>\n";
         print "</tr>\n";
         $j++;
        }
        print "</form>\n";
        print "<tr>\n";
        $qwe="<h2>Редактировать</h2>";
        print "<td colspan='2'><center><a href='glav.php?lnk=tests&reason=edit&tid=$tid'>$qwe</a></center></td>\n";
        print "</tr>\n";
        print "</table>\n";
     }
  elseif ($reason=="edit")
    {      $tid=$_GET['tid'];      $q=mysql_query("SELECT * FROM `text_test` WHERE `id_tests` = '$tid'");
      $q1=mysql_query("SELECT * FROM `tests` WHERE `id` = '$tid'");
      while($row1=mysql_fetch_array($q1))
        {          $tname=$row1[3];
          $pid=$row1[1];
        }
      $q2=mysql_query("SELECT * FROM `predmet`");
      print "<table align='center' valign='midle' cellpaddind='7' width='70%'>";
      print "<form name='' action='glav.php?lnk=tests&reason=editdone&tid=$tid' method='post'>\n";
      print "<tr>\n";
      print "<td><center>Название раздела</center></td>\n";
      print "<td><center><input name='tname' type='text' size='35' value='$tname'></center></td>\n";
      print "</tr>\n";
      print "<tr>\n";
      print "<td><center>Предмет</center></td>\n";
      print "<td><center>\n";
      print "<select size='1' name='pid'>\n";
      while($row2=mysql_fetch_array($q2))
      {      	if($pid==$row2[0])
      	  {
           print "<option value='$row2[0]' SELECTED>$row2[1]</option>\n";
          }
        else
          {           print "<option value='$row2[0]'>$row2[1]</option>\n";
          }
      }
      print "</select></center></td>\n";
      print "</tr>\n";
      $j=1;
      while($row=mysql_fetch_array($q))
        {          print "<tr>\n";
          print "<td colspan='2'><b>Вопрос $j:</b></td>\n";
          print "</tr>\n";
          print "<tr>\n";
          print "<td><center>Текст вопроса:</center></td>\n";
          $ttext=$row[2];
          $ttext=nl2br($ttext);
          print "<td><center><textarea class='text' name='ttext$j' rows=5 cols=50 wrap='on'>$ttext</textarea></center></td>\n";
          print "</tr>\n";
          print "<tr>\n";
          print "<td><center>Варианты ответа:</center></td>\n";
          $totvet=$row[3];
          print "<td><center><textarea class='text' name='totvet$j' rows=10 cols=50 wrap='on'>$totvet</textarea></center></td>\n";
          print "</tr>\n";
          print "<tr>\n";
          print "<td><center>Правильные ответы:</center></td>\n";
          print "<td><center><input name='otvet$j' type='text' value='$row[4]'></center></td>\n";
          print "</tr>\n";
          print "<input name='textid$j' type='hidden' value='$row[0]'>\n";
          $j++;
        }
      print "<th><hr></th><th><hr></th>\n";
      print "<tr>\n";
      print "<td><input name='num' type='hidden' value='$j'></td>\n";
      print "<td><center><input type='submit' value='Принять изменения'></center></td>\n";
      print "</tr>\n";
      print "</form>\n";
      print "</table>\n";
     }
    elseif($reason=="editdone")
    {     $tid=$_GET['tid'];
     $pid=$_POST['pid'];
     $tname=$_POST['tname'];
     $n=$_POST['num'];
     $query="UPDATE `tests` SET `id_predmet` = '$pid', `name` = '$tname' WHERE `id` = '$tid'";
     mysql_query($query);
     for($i=1;$i<=$n;$i++)
        {          $ttext=$_POST["ttext$i"];
          $totvet=$_POST["totvet$i"];
          $otvet=$_POST["otvet$i"];
          $textid=$_POST["textid$i"];
          $query1="UPDATE `text_test` SET `test_text` = '$ttext', `test_otvets` = '$totvet', `otvet` = '$otvet' WHERE `id` = '$textid'";
          mysql_query($query1);
          print "<meta http-equiv='refresh' content='0; url=glav.php?lnk=tests&reason=view&tid=$tid'>\n";
        }

     print "<meta http-equiv='refresh' content='2; url=glav.php?lnk=tests&reason=view&tid=$tid'>\n";
    }
    else    //просмотр скомпанованного теста
    {
      $q=mysql_query("SELECT * FROM `gotov_test`");
      $no_tests=mysql_num_rows($q);
      if($no_tests==0)
      {      	print "<br /><br /><br /><br /><div align='center'>Тестов в системе не обнаружено</div>";
      }
      else
      {
       {print "
        <br /><br />
        <center>Список тестов</center>
        <br /><br />
        <table align='center' valign='midle' cellpaddind='7' width='70%'>
        <tr class='shapka'>
        <td><center>Название</center></td>

        <td align='center'>Предмет</td>

        <td align='center'>Автор</td>

        <td></td>
        <td></td>
        </tr>
       ";}
       while($row=mysql_fetch_array($q))
         {
           $predmetid=$row[3];
           $authorid=$row[4];           $getpredmet=mysql_query("SELECT * FROM `predmet` WHERE `id` = '$predmetid'");
           $getauthorname=mysql_query("SELECT * FROM `users` WHERE `id` = '$authorid'");
           while($row1=mysql_fetch_array($getpredmet))
             {               $predmetname=$row1[1];
               $predmetname=ucfirst($predmetname);
             }
           while($row2=mysql_fetch_array($getauthorname))
             {               $authorname=$row2[4];
             }           {print "
            <tr class='tr' $styletr>
            <td>
            <center><a href='glav.php?lnk=testirovanie&gtid=$row[0]'>$row[1]</a></center>
            </td>
            <td align='center'>$predmetname</td>

            <td align='center'><a href='glav.php?lnk=user&uid=$authorid'>$authorname</a></td>
            <td>

            <center><a href='glav.php?lnk=edittest&id=$row[0]&reason=edit'>Редактировать</a></center>

            </td>

            <td>

            <center><a href='glav.php?lnk=edittest&id=$row[0]&reason=drop'>Удалить</a></center>

            </td>

            </tr>
           ";}
         }
       }
    }
 }
?>