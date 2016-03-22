<?php

define(VALUE_DILIM , " &*#VBE*~ ");
define(ROW_DILIM, " !_!&SECTIONDILIM!_!& ");
 
// ROW: Section Name, Section Note, query name, query note, query value...

function getRows($rawData, &$outArray)
{
	$vals = explode(VALUE_DILIM , $rawData);

	$row = extractRow($vals);
	
	while($row != NULL)
	{
		$outArray[] = $row;
		$row = extractRow($vals);
	}
}
 
function listQueryGroups($rows)
{
	$out = "########## SQL Dictionary ###########\r\r";
	
	for($i = 0; $i < count($rows); $i++)
	{
		$queryCounter = 0;
		$out .= 
		"#----- ".$rows[$i][0]." -----#\r ".
		"# Queries: ".((count($rows[$i]) - 2)/3)."\r";
		
		// Print out all of the query names.
		for($f = 1; $f <= ((count($rows[$i]) - 2)/3); $f++)
		{
			++$queryCounter;
			$out .= $queryCounter.".) ".$rows[$i][( ($f * 3) - 1 )]."\r";
		}
			
		$out .= "-----------------------------\r\r";
	}
	
	echo($out);
}

function rowSummaries($rows)
{
	$out = "";
	
	for($i = 0; $i < count($rows); $i++)
	{
		$out .= 
		"#----- ".$rows[$i][0]." -----#\n ".
		"# Description : ".$rows[$i][1]."\n".
		"# Queries: ".((count($row[$i]) - 2)/3)."\n".
		"-----------------------------\n";
	}
	
	echo $out;
}

function extractRow(&$vals)
{
	$row = array(); 
	$capture = false; 
	
	for($i = 0; $i < count($vals); $i++)
	{
		if(strcasecmp(ROW_DILIM, $vals[$i]) == 0  )
		{
			
			// Start row dilim.
			if(!$capture)
			{
				$capture = true;
			}
			else
			{
				// Need to return the row. 
				
				// Remove captured values from array.
				$vals = array_slice($vals,$i + 1);
				
				// Return row.
				
				return $row; 
			}
		}
		else
		{
			// If we are capturing rows.
			if($capture)
			{
				$row[] = $vals[$i];
			}
		}
	}
	
	return NULL;
}

?>