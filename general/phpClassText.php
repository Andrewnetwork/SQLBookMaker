<?php

function generateSectionCode($row)
{
	$queryStrings = "";
	
	$topSegment = 
	'/** Description 
	 *
	 * This segment explains what queries are in $imageSection. 
	 *
	 **/
	$sectionLabel = "'.$row[0].'"; 
	
	if($nArgs == 0 ||  $enabledSections[$sectionLabel] == 1 )
	{
		$temp = array
		(';
	
	
	// Generate all of the query strings. 
	for($i = 1; $i <= (count($row) - 2) / 3; $i++)
	{
		if($i + 1 <= ((count($row) - 2) / 3))
		{
			$queryStrings .= '"'.$row[($i * 3) - 1].'" => "'.$row[($i * 3) - 1 + 2].'",';
		}
		else
		{
			// Last query. 
			$queryStrings .= '"'.$row[($i * 3) - 1].'" => "'.$row[($i * 3) - 1 + 2].'"';
		}
	}
		
	$bottomSegment = 
	');
		$this->appendToSections($sectionLabel, $temp);
	}';
	
	
	return $topSegment.$queryStrings.$bottomSegment; 
}

$top = 
'<?php
/** SqlBook.php
 *
 *** META ***
 * Creator: Andrew Ribeiro
 * Date Of Creation: April 1, 2010
 * Date Last Modified: April 2, 2010
 * Version: 0.5
 *** END META ***
 *
 *** Description ***
 * This file contains the class SQLBook. The purpose of this class is to keep 
 * an orderly collection of various queries used whithin a project.
 *** END Description ***
 *
**/

class SQLBook
{
	//########## Private Members ##############
	
	private $insertValueFunctionIdentifier = "INSERT_VALUE";
	
	private $SQLSections = array();
	
	private function appendToSections($label, $section)
	{
		$this->SQLSections[$label] = $section;
	}
	
	//########## END Private Members ##############
	
	//########## Public Members #################
	
	public function __construct()
	{
		$nArgs = func_num_args();
		
		if($nArgs > 0)
		{
			$enabledSections = func_get_arg(0);
		}
	
		//########## SQL section definitions ##########
		';



$bottom ='
	//########## END SQL section definitions ########## 
	}
	
	/** Description 
	 *
	 * This function returns a query that does not have any arguments. 
	 * @arg1: The section the desired query is in. 
	 * @arg2: The id or label for the particular query. 
	 *
	 **/
	public function getQuery($sqlSectionID, $sqlQueryID )
	{
		return  $this->SQLSections[$sqlSectionID][$sqlQueryID];
	}
	
	/** Description 
	 *
	 * This function returns a query that has arguments.
	 * @arg1: The section the desired query is in. 
	 * @arg2: The id or label for the particular query. 
	 * @arg3: An associative array linking the place holder ids to a particular value.
	 *        EX: "ID" => 1, where the value of the ID place holder is 1. 
	 *
	 **/
	public function subArgs($sqlSectionID, $sqlQueryID , $valueArray)
	{
		$sqlTemplate = $this->SQLSections[$sqlSectionID][$sqlQueryID];
		
		if(count( $valueArray ) > 0)
		{
			// Substitute arguments. 
			$fnPos = 0;
			$fnPos = stripos($sqlTemplate, $this->insertValueFunctionIdentifier, $fnPos);
			
			while($fnPos !== FALSE)
			{
				// Get the start of the argument
				$argStartPos = strlen($this->insertValueFunctionIdentifier) + $fnPos + 1; 
				// Get the end of the argument
				$argEndPos = stripos($sqlTemplate , ")" , $argStartPos + 1);
				// Get the argument. 
				$arg = substr($sqlTemplate , $argStartPos , $argEndPos - $argStartPos );
				// Find the value for the argument. 
				$argVal = $valueArray[strtoupper($arg)]; 
				// Replace the arg in the string
				$sqlTemplate = substr_replace($sqlTemplate, $argVal, $fnPos, ($argEndPos - $fnPos) + 1);
	
				// Find the next substitution function. 
				$fnPos = @stripos($sqlTemplate ,$this->insertValueFunctionIdentifier, 
									$fnPos + strlen($this->insertValueFunctionIdentifier) );
			}
		}
		
		return $sqlTemplate;
	}
	//########## END Public Members #################
}
?>';

?>