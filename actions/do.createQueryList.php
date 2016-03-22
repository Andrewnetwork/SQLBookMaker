<?php

require_once("../general/functions.php");

$rows = array();

$dat = NULL;


if( isset($_GET["dat"]) )
{
	$dat = $_GET["dat"];
}
else
{	
	$dat = $_POST["dat"];
}




getRows($dat , $rows);

header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="SqlDictionary.txt"');

listQueryGroups($rows);

echo("\r\r###### Created By: Andrew Ribeiro\r");
echo("###### Website: http://www.andrewribeiro.com\r");

?>