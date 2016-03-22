<?php 
header('Content-type: application/x-httpd-php');
header('Content-Disposition: attachment; filename="SQLBook.php"');

require_once("../general/functions.php");
require_once("../general/phpClassText.php");

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

$sectionArrays = "";

// Generate the necissary code for each section.
for($i = 0; $i < count($rows); $i++)
{
	$sectionArrays .= generateSectionCode($rows[$i]);
}



// Return the full code. 
echo($top.$sectionArrays.$bottom);

?>