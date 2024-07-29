#!/usr/bin/php -q
<?php

require_once('/var/lib/asterisk/agi-bin/phpagi.php');
$agi=new AGI();

function connect_db() {
$db_connection = mysql_connect('localhost','root','SENHA_DO_DATABASE') or die (mysql_error());
$db_select = mysql_select_db('call_center') or die (mysql_error());
}
connect_db();

$satisfacao = $argv[1];
$callerid = $argv[2];
$nota = $argv[3];
$operador = $argv[4];
$uniqueid = $argv[5];
$empresa = $argv[6];

$vowels = array('SIP/','IAX2/','IAX/','Agent/');
$operador_number = str_replace($vowels,'',$operador);

$query = "select name from agent where number='$operador_number'";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$operador = $row[0];

$atendedor = "$operador";

$query = mysql_query("insert into pesquisa (datetime,info1,info2,info3,info4,info5,info6) values (NOW(),'$satisfacao','$callerid','$atendedor','$nota','$uniqueid','$empresa')");
$sel = mysql_query($query);
