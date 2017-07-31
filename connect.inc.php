<?php
$mysql_username = 'root';
$mysql_password = '';
$mysql_db = 'CollegeDatabase';
$mysql_host = 'localhost';
$sql_connection = mysql_connect($mysql_host,$mysql_username,$mysql_password);
$sql_db_property = mysql_select_db($mysql_db);
if(!$sql_connection||!mysql_select_db($mysql_db))
{
	echo 'Couldn\'t connected<br>';
	die();
}
/*else
{
	//echo 'connected<br>';
}*/
?>
