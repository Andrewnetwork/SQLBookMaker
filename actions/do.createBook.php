<?php 
// This file creates a document that will be used to load books back into the editor. 

header('Content-type: plain/text');
header('Content-Disposition: attachment; filename="SQLBook.sb"');

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

echo(serialize($rows));
?>