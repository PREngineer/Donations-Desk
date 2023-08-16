<?php

$link = mysql_pconnect(“localhost”, "asesore3_ddesk", "JMPS#AfC14") or die("Could not connect");
mysql_select_db("asesore3_donationsdesk") or die("Could not select database");
 
$arr = array();

$rs = mysql_query("SET NAMES 'utf8'"); //Corrects problem with special characters
$rs = mysql_query("SELECT * FROM `OSFL` WHERE active='1' ORDER BY `organization-name` ");

 
while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo '{"info":'.json_encode($arr).'}';


?>