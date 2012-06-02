<?php
//Таблица USERS
$Qtableusers = "CREATE TABLE `users` ( ";$Qtableusers .= "id int(20) NOT NULL auto_increment, ";$Qtableusers .= "mail text default NULL, ";$Qtableusers .= "password text default NULL, ";$Qtableusers .= "name text default NULL, ";$Qtableusers .= "fname text default NULL, ";$Qtableusers .= "grp text default NULL, ";$Qtableusers .= "authlevel int(1) NOT NULL, ";
$Qtableusers .= "PRIMARY KEY (`id`) ";$Qtableusers .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
//Таблица PREDMET
$Qtablepredmet = "CREATE TABLE `predmet` ( ";$Qtablepredmet .= "`id` int(20) NOT NULL auto_increment, ";$Qtablepredmet .= "`name` text default NULL, ";$Qtablepredmet .= "PRIMARY KEY(`id`) ";$Qtablepredmet .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
//TESTS
$Qtabletests = "CREATE TABLE `tests` ( ";$Qtabletests .= "`id` int(20) NOT NULL auto_increment, ";$Qtabletests .= "`id_predmet` int(20) NOT NULL, ";$Qtabletests .= "`id_users` int(20) NOT NULL, ";$Qtabletests .= "`name` text default NULL, ";$Qtabletests .= "PRIMARY KEY(`id`) ";$Qtabletests .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
//TEXT_TEST
$Qtabletexttest = "CREATE TABLE `text_test` ( ";$Qtabletexttest .= "`id` int(20) NOT NULL auto_increment, ";$Qtabletexttest .= "`id_tests` int(20) NOT NULL, ";$Qtabletexttest .= "`test_text` text default NULL, ";$Qtabletexttest .= "`test_otvets` text default NULL, ";$Qtabletexttest .= "`otvet` text default NULL, ";$Qtabletexttest .= "PRIMARY KEY(`id`) ";$Qtabletexttest .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
//STUD_OTVET
$Qtablestudotvet = "CREATE TABLE `stud_otvet` ( ";$Qtablestudotvet .= "`id` int(50) NOT NULL auto_increment, ";$Qtablestudotvet .= "`id_users` int(20) NOT NULL, ";$Qtablestudotvet .= "`id_tests` int(20) NOT NULL, ";$Qtablestudotvet .= "`id_text_tests` int(20) NOT NULL, ";$Qtablestudotvet .= "`otvet_stud` text default NULL, ";
$Qtablestudotvet .= "`data` text default NULL, ";$Qtablestudotvet .= "PRIMARY KEY(`id`) ";$Qtablestudotvet .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
//DOSTUP
$Qtabledostup = "CREATE TABLE `dostup` ( ";$Qtabledostup .= "`id_user` int(50) NOT NULL , ";$Qtabledostup .= "`id_test` int(20) NOT NULL, ";$Qtabledostup .= "`end_time` text default NULL, ";
$Qtabledostup .= "`kto` text default NULL, ";$Qtabledostup .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
//componovka
$Qtablegotovtest = "CREATE TABLE `gotov_test` ( ";$Qtablegotovtest .= "`id` int(50) NOT NULL auto_increment, ";$Qtablegotovtest .= "`name` text default NULL, ";$Qtablegotovtest .= "`testy` text default NULL, ";
$Qtablegotovtest .= "`predmet` text default NULL, ";
$Qtablegotovtest .= "`author` text default NULL, ";$Qtablegotovtest .= "PRIMARY KEY(`id`) ";$Qtablegotovtest .= ") ENGINE=MyISAM CHARACTER SET cp1251;";
?>
