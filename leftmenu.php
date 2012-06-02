<?php
//Общие ссылки
$link[1]="<a class='pushbutt' href='glav.php?lnk=glavnaya'>Главная</a><br />";
$link[2]="<a class='pushbutt' href='glav.php?lnk=tests'>Тесты</a><br />";
$link[3]="<a class='pushbutt' href='logout.php' target=_top>Выход</a><br />";
//Ссылки преподователей
$link[4]="<a class='pushbutt' href='glav.php?lnk=redactor&step=1'>Редактор разделов</a><br />";
$link[5]="<a class='pushbutt' href='glav.php?lnk=results'>Результаты</a><br />";
//Ссылки Администратора
$link[6]="<a class='pushbutt' href='glav.php?lnk=admin/users'>Пользователи</a><br />";
$link[7]="<a class='pushbutt' href='glav.php?lnk=predmety'>Предметы</a><br />";
$link[8]="<a class='pushbutt' href='glav.php?lnk=user'>Мои данные</a><br />";
$link[9]="<a class='pushbutt' href='glav.php?lnk=componovka&step=1'>Компоновка теста</a><br />";
$link[10]="<a class='pushbutt' href='glav.php?lnk=dostup'>Допуск</a><br />";
$authlevel=$_SESSION['authlevel'];
if ($authlevel==1) //user
{
$page .= "<hr><center><b>Главное меню</b></center><hr>";
$page .= $link[1];
$page .= $link[2];
$page .= $link[8];

$page .= $link[5];
$page .= "<hr>";
$page .= $link[3];
}
elseif ($authlevel==2) //prepod
{
$page .= "<hr><center><b>Главное меню</b></center><hr>";
$page .= $link[1];
$page .= $link[2];
$page .= $link[8];
$page .= "<hr><center><b>Редактирование</center></b><hr>";
$page .= $link[7];
$page .= $link[4];
$page .= $link[9];
$page .= $link[5];
$page .= $link[10];
$page .= "<hr>";
$page .= $link[3];
}
elseif ($authlevel==3)  //admin
{
$page .= "<hr><center><b>Главное меню</b></center><hr>";
$page .= $link[1];
$page .= $link[2];
$page .= $link[8];
$page .= "<hr><center><b>Редактирование</center></b><hr>";
$page .= $link[7];
$page .= $link[4];
$page .= $link[9];
$page .= $link[5];
$page .= $link[6];
$page .= $link[10];
$page .= "<hr>";
$page .= $link[3];
}
else
{
print "Так просто";
}
print $page;
?>


