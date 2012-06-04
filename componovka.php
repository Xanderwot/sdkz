<?php
session_start();include("includes/include.php");
$authlevel=$_SESSION['authlevel'];
$uid=$_SESSION['id'];
$step=$_GET['step'];
if ($authlevel==1) { print "<meta http-equiv='refresh' content='0; url=frames.php'>\n"; }
else { 
  if ($step==1) {
    $q=mysql_query("SELECT * FROM `predmet`");
    {print "<div align='center'>Процесс создания готового теста.</div>\n
            <table align='center' valign='midle' cellpadding='7' width='70%'>\n
              <tr>\n
                <td align='center'>\n
                  Выберите предмет\n
                </td>\n
                <td align='center'>\n
                  <select id='block' size=\"1\" onChange='javascript:menu()' name='pid'>\n
                  <option value=''>Выбор предмета</option>\n";}
    while($row=mysql_fetch_array($q)) { print "<option value='$row[0]'>$row[1]</option>\n"; }
    {print "</select>\n
                </td>\n
              </tr>\n
            </table>\n";}
  }
  elseif ($step==2) { 
    $pid=$_GET['pid'];
    $q=mysql_query("SELECT * FROM `predmet`");
    {print "<div align='center'>Процесс создания готового теста.</div>\n
            <table align='center' valign='midle' cellpadding='7' width='70%'>\n
              <form name='' action='glav.php?lnk=componovka&step=3' method='post'>\n
                <tr class='tr'>\n
                  <td align='center'>\n
                    Выберите предмет\n
                  </td>\n
                  <td align='center'>\n
                    <select id='block' size='1' onChange='javascript:menu()' name='pid'>\n";}
    while($row=mysql_fetch_array($q)) {
      if ($pid==$row[0]) {
        print "<option value='$row[0]' SELECTED>$row[1]</option>\n"; }
      else { print "<option value='$row[0]'>$row[1]</option>\n"; }
      }
    {print "</select>\n
            </td>\n
            </tr>\n";}
    $q1=mysql_query("SELECT * FROM `tests` WHERE `id_predmet` = '$pid'");
    $i=0;
    $error=mysql_num_rows($q1);
    if ($error==0) {
      print "<tr class='tr'><td colspan='2'><center>\n";          print "<br /><br /><br /><br /><hr>Нет ни одного теста для данного предмета.<hr>\n";
      print "</center></td></tr>\n"; }
    else { 
      print "<tr class='tr'>";
      print "<td><center>";
      print "Название искомого теста";
      print "</center></td>";
      print "<td><center>";
      print "<input name='name' type='text' value=''>";
      print "</center></td>";
      print "</tr>";        print "<tr class='tr'>\n";
      print "<td><center>Название включаемого подтеста</center></td>\n";
      print "<td><center>Количество включаемых вопросов</center></td>\n";
      print "</tr>\n";
      while($row1=mysql_fetch_array($q1)) {
       	print "<tr class='tr' $styletr>\n";
       	print "<td>\n";
       	print "<input name='testchekbox$i' type='checkbox' value='on'>\n";
       	print "<input name='tid$i' type='hidden' value='$row1[0]'>\n";
       	print "<b>$row1[3]</b>\n";
       	print "</td>\n";
        $q2=mysql_query("SELECT * FROM `text_test` WHERE `id_tests` = '$row1[0]'");
        $j=0;
        while($row2=mysql_fetch_array($q2)) { $j++; }
       	print "<td><center>\n";
       	print "<input id='$i' name='testnum$i' type='text' size='3' value=''>\n";
       	print "<a class='knopka' href=# onClick='javascript:max_value($j,$i)'>  Max: $j</a>\n";
       	print "</center></td>\n";
       	print "</tr>\n";
        $i++;
      }
      print "<tr>\n";
      print "<td colspan='2'>\n";
      print "<input name='pid' type='hidden' value='$pid'>\n";
      print "<center><input type='submit' value='Компоновка'></center>\n";
      print "<input name='num' type='hidden' value='$i'>\n";
      print "</td>\n";
      print "</tr>\n";
      print "</form>\n";
      print "</table>\n";
    }
  }
  elseif($step==3) {
    $query="";
    $n=$_POST['num'];
    $pid=$_POST['pid'];
    $name=$_POST["name"];
    if($name=="") {
      print "<center><hr>Не введено название теста!<hr></center>\n";
      print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=componovka&step=1'>\n"; }
    else {
      for($i=0;$i<=$n;$i++) {
        $testchekbox=$_POST["testchekbox$i"];
       	$tid=$_POST["tid$i"];
       	$testnum=$_POST["testnum$i"];
       	if($testchekbox=="on") {
          if( !$testnum=="") { $query .="$tid;$testnum;"; }
        }
      }
      if ($query=="") { 
        print "<br /><br /><br /><hr><center>Ошибка! Не выбран ни один тест или количество вопросов не указано.</center><hr>\n";          	
        print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=componovka&step=1'>\n"; }
      else { 
        $nametest=mysql_query("SELECT * FROM `gotov_test` WHERE `name` = '$name'");
        $nameerror=mysql_num_rows($nametest);
        if(! $nameerror == 0) { 
          print "<br /><br /><br /><hr>Тест с таким именем уже существует.<hr>\n";
          print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=componovka&step=1'>\n"; }
        else {
          $q="INSERT INTO `gotov_test` VALUES (0, '$name', '$query', '$pid', '$uid')";               
          mysql_query($q);               print "<br /><br /><br /><hr>Ваш запрос успешно обработан...<hr>\n";               
          print "<meta http-equiv='refresh' content='3; url=glav.php'>\n"; }
      }
    }
  }
}  
?>