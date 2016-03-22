<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script language="javascript" type="text/javascript" src="general/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript">
	
	// Setting up the script variables. 
	
	var selectedSectionID = null;
	var nSections = 0;
	var notes = new Array();
	var queries = new Array();

</script>
<script language="javascript" type="text/javascript" src="general/functions.js"></script>
<script language="javascript" type="text/javascript" src="general/loadFunctions.js"></script>

<link rel="stylesheet" href="general/style.css" type="text/css" />

<title>Andrew Ribeiro's SQL Book Maker</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="SQL" http-equiv="keywords" />
</head>

<body>
<div style="position:absolute; visibility:hidden;">
	<iframe id="hiddenFrame"></iframe>
</div>

<div style="position:absolute; top:0px; left:0px;"><img src="img/betaTag.png" alt="This product is currently in beta" /></div>

<div style="width:530px; margin:0 auto; margin-top:5%;">
	<div style="margin-bottom:1em; position:relative; left:-45px;">
		<img src="img/logo.png" />
	</div>
		<table height="410" width="530" border="0" cellpadding="0" cellspacing="0" background="img/layout.png" style="background-repeat:no-repeat;">
		  <!--DWLayoutTable-->
		  <tr>
			<td height="21" colspan="2" valign="top" style="cursor:pointer;"><!--DWLayoutEmptyCell-->&nbsp;</td>
		    <td width="93">&nbsp;</td>
		    <td width="7">&nbsp;</td>
		    <td width="44"></td>
		    <td width="8"></td>
		    <td width="31"></td>
		    <td width="36"></td>
		    <td width="77"></td>
		    <td width="185"></td>
		    <td width="13"></td>
		    <td width="25"></td>
		  </tr>
		  <tr>
		    <td width="3" height="14"></td>
		    <td width="8"></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td height="23"></td>
		    <td colspan="3" valign="top" style="cursor:pointer;">
			<div style="width:100%; height:100%;">
				<div onclick="add()" style="float:left; position:relative; left:5px; width:32px; height:22px;"></div>
				<div onclick="remove()" style="float:left; position:relative; left:9px; width:32px; height:22px;"></div>
				<div onclick="rename()" style="float:left; position:relative; left:10px; width:35px; height:22px;"></div>
			</div>			</td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		  
		  
		  
		  <tr>
		    <td height="229"></td>
		    <td></td>
		    <td colspan="3" rowspan="2" valign="top">
			  <div id="itemNav" style="height:240px; width:100%; overflow:auto; margin-left:6px; padding-top:5px;"></div></td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td colspan="4" valign="top"><label>
		      <textarea onchange="propertyChange(this)" onkeydown="propertyChange(this)" id="property" name="textarea" style="width:100%; height:227px;"  disabled=""></textarea>
		    </label></td>
		    <td>&nbsp;</td>
		  </tr>
		  <tr>
		    <td height="17"></td>
		    <td></td>
		    <td></td>
		    <td colspan="2" rowspan="2" valign="top" style="cursor:pointer;"><!--DWLayoutEmptyCell-->&nbsp;</td>
		    <td rowspan="2" valign="top" style="cursor:pointer;"><!--DWLayoutEmptyCell-->&nbsp;</td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td height="14"></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		  
		  
		  
		  <tr>
		    <td height="19"></td>
		    <td></td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td></td>
		    <td></td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td height="48"></td>
		    <td></td>
		    <td>&nbsp;</td>
		    <td colspan="8" rowspan="2" valign="top">
				<div style="position:relative; top:-5px; left:0.7px;"><textarea disabled="disabled" id="noteBox" onkeydown="noteChange(this)" onchange="noteChange(this)" name="textarea2" cols="" rows="" style="width:396px; height:62px;"></textarea></div>
			</td>
		    <td></td>
	      </tr>
		  
		  
		  
		  
		  
		  <tr>
		    <td height="27" colspan="2" valign="top" style="cursor:pointer;"><!--DWLayoutEmptyCell-->&nbsp;</td>
		    <td></td>
		    <td>&nbsp;</td>
		  </tr>
		  <tr>
		    <td height="0"></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
	      </tr>
		</table>
		<div style="text-align:center; margin-top:5px;">
			<button onclick="makeBook()" style="width:32%; float:left">Create book</button>
			<button onclick="generateDocumentation()" style="width:33%;">Create documentation</button>
			<button onclick="generateQueryList()" style="width:32%;">Create query list</button>
			
			<button onclick="loadBook()" style="width:32%; clear:left;">Load  Book</button>
			<button onclick="makeClass()" style="width:32%; clear:left;">Create PHP Class</button>
		</div>
		
		<div style="margin-top:10px; background-color:#999999; border:thin #000000 solid; text-align:center; padding:3px;">
			Created By Andrew Ribeiro 
			
			<!-- AddThis Button BEGIN -->
			<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4bb5da8d0015d65d"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4bb5da8d0015d65d"></script>
			<!-- AddThis Button END -->


		</div>
	<div>
	
  </div>
</div>

<?php

// Check if data is being loaded into the form. 
if($_FILES['dat']['tmp_name'] != NULL)
{
	$fileDat = file_get_contents($_FILES['dat']['tmp_name']);
	
	
	// Data is being loaded. 
	$rows = unserialize($fileDat);

	
	// If there is atleast one row to be loaded. 
	if(count($rows) >= 1)
	{
		echo('<script language="javascript" type="text/javascript">');
		echo('var sectionName = null;');
		
		// For each section. 
		for($rowNum = 0; $rowNum < count($rows); $rowNum++)
		{
			echo('sectionName = loadSection("'.$rows[$rowNum][0].'","'.$rows[$rowNum][1].'");');
			
			for($element = 1; $element <= (count($rows[$rowNum]) - 2) / 3; $element++)
			{
				$firstQueryPos = ( ($element * 3) - 1 );
				
				$queryName = $rows[$rowNum][$firstQueryPos];
				$queryNote = $rows[$rowNum][$firstQueryPos + 1];
				$querySql = $rows[$rowNum][$firstQueryPos + 2];
				
				// Load each query into each section.
				echo('loadQuery(sectionName,"'.$queryName.'","'.$queryNote.'","'.$querySql.'");');
			}
		}
		
		echo('</script>');
	}
}


?>

</body>
</html>
