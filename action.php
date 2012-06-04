<?php
session_start();
$uid=$_SESSION['id'];
$gtid=$_POST['gtid'];
$itog=$_POST['itog'];
$data=date('H:i:s  d-m-Y');
for($i=1;$i<=$itog;$i++) { 
  $kolich=$_POST["kolich$i"];
  for($j=0;$j<$kolich;$j++) { 
    $tid=$_POST["tid$i$j"];
    $temp="";
      for($t=1;$t<=10;$t++) {
        $name="input$i$j";
        if( !$_POST["$name$t"]==""){ $temp .=$_POST["$name$t"].","; }
        elseif( !$_POST["radio$i$j"]==""){ $temp .=$_POST["radio$i$j"].","; }
        $n=strlen($temp);
        $temp=substr($temp,0,$n-1);
        mysql_query("INSERT INTO `stud_otvet` VALUES (0, '$uid', '$gtid', '$tid', '$temp', '$data')") or die(mysql_error());
      }
  }
}  
mysql_query("DELETE FROM `dostup` WHERE `id_user` = '$uid' AND `id_test` = '$gtid'") or die (mysql_error());
print "<div align='center'>Тестирование окончено.</div>";
?>