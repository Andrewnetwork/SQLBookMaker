// JavaScript Document
function noteChange(textBox)
{
	notes[selectedSectionID] = textBox.value; 
}

function propertyChange(textBox)
{
	if(selectedSectionID.indexOf("query") != -1)
	{
		// If the selected item is a query. 
		queries[selectedSectionID] = textBox.value;
	}
}

function loadSelectionProperty()
{
	if(selectedSectionID != null && selectedSectionID.indexOf("query") != -1)
	{
		// If the selected item is a query. 
		if(queries[selectedSectionID] != null)
		{
			document.getElementById("property").value = queries[selectedSectionID];
		}
		else
		{
			document.getElementById("property").value = "";
		}
	}
	else
	{
		document.getElementById("property").value = "";
	}
}

function loadSelectionNote()
{
	if( notes[selectedSectionID] != null)
	{
		document.getElementById("noteBox").value = notes[selectedSectionID];
	}
	else
	{
		document.getElementById("noteBox").value = "";
	}
}

function expandSection(htmlEnt)
{
	nSections++;
	
	var divID = "query"+nSections;
	
	var nd = document.createElement("div");
	
	htmlEnt.parentNode.appendChild(nd);

	nd.setAttribute("class","subItem");
	
	nd.setAttribute("onclick","selectElement('"+divID+"')");
	
	nd.innerHTML = "<div class='subMinus'>-</div><span class='queryName' id='"+divID+"' onmouseover='changeElementColor(this)' onmouseout='changeElementColorBack(this)' onclick='selectElement('"+divID+"')' >Unamed Query</span>";
	
	htmlEnt.parentNode.appendChild(nd);
}



function add()
{
	nSections++;
	
	document.getElementById("itemNav").innerHTML += "<div class='navElement'><div onclick='expandSection(this)' class='expandPlus'>+</div><span id='sectionHead"+ (nSections) +"' onclick='selectElement(\"sectionHead"+ (nSections) +"\")' onmouseout='changeElementColorBack(this)' onmouseover='changeElementColor(this)' class='sectionTitle'>Unamed Query</span></div>";

}

function selectElement(id)
{
	document.getElementById("noteBox").disabled = false;
	
	if(id != selectedSectionID)
	{
		var prev = selectedSectionID;
		selectedSectionID = id;
		
		var propertyTxtBox = document.getElementById("property");
		
		if( selectedSectionID.indexOf("query") != -1)
		{
			// Is a query. 
			propertyTxtBox.disabled = false;
			
		}
		else
		{
			// Is not a query. 
			propertyTxtBox.disabled = true;
			propertyTxtBox.value = "";
		}
		
		if(	prev != null)
		{	
			 changeElementColorBack(document.getElementById(prev));
		}
		
		// Load in the notes for the selection. 
		loadSelectionNote();
		
		// Load in the property for the selection.
		loadSelectionProperty();
	}
	else
	{
		// The user wants to deselect. 
		/* Disable deselect for now.
		selectedSectionID = null;
		
		document.getElementById("property").disabled = true;
		document.getElementById("property").value = "";
		document.getElementById("noteBox").value = "";
		document.getElementById("noteBox").disabled = true;
		*/
	}
}

function editTitle(htmlElm)
{
	if(htmlElm.innerHTML.indexOf('<input name="rename" type="text"') == -1)
	{
		htmlElm.innerHTML = '<input name="rename" type="text" value="'+htmlElm.innerHTML+'" />';
	}
	else
	{
		htmlElm.innerHTML = htmlElm.getElementsByTagName("input")[0].value ;
	}
}

function changeElementColor(htmlElm)
{
	htmlElm.style.backgroundColor = "#CCCCCC";
}
function changeElementColorBack(htmlElm)
{
	if(htmlElm.getAttribute('id') != selectedSectionID)
	{
		htmlElm.style.backgroundColor = "#FFFFFF";
	}
}

function remove()
{
	document.getElementById(selectedSectionID).parentNode.innerHTML = "";
	
	// Remove the deleted selection id from the selected id. 
	selectedSectionID = null;
	
	document.getElementById("property").disabled = true;
	document.getElementById("property").value = "";
	document.getElementById("noteBox").value = "";
	document.getElementById("noteBox").disabled = true;

}

function rename()
{
	if(selectedSectionID != null)
	{
		editTitle( document.getElementById(selectedSectionID) );
	}
}

/**
 * This function collects data from the user interface, and models it so that 
 * a php script can use the data. 
**/
function genDataString()
{
	var out = new Array();
	
	
	var items = document.getElementById("itemNav");
	
	var div = items.firstChild;
	
	var row = new Array();
	
	// Itterate through each section.
	while(div != null)
	{
		var spans = div.getElementsByTagName("SPAN");
		
		// Push on the section title. 
		out.push(" !_!&SECTIONDILIM!_!& ");
		out.push(spans[0].innerHTML); 
		
		if(notes[spans[0].id] != null)
		{
			out.push(notes[spans[0].id]);
		}
		else
		{
			out.push("");
		}
		
		var queries = div.getElementsByTagName("SPAN");
	
		// Itterate through each query 
		for(var i = 0; i < queries.length; i++)
		{
			if(queries[i].className == "queryName")
			{
				putQuery(out, queries[i].innerHTML, queries[i].id);
			}
			
		}

		out.push(" !_!&SECTIONDILIM!_!& ");
		
		div = div.nextSibling;
	}
	
	var strOut = "";
	
	for(var i = 0; i < out.length; i++)
	{
		strOut += (out[i] + " &*#VBE*~ ");
	}
	
	return strOut;
}



function putQuery(array,queryName, queryID)
{
	// This function places a queries notes, properties and name into the array.
	
	array.push(queryName);
	
	if(notes[queryID] != null)
	{
		array.push(notes[queryID]);
	}
	else
	{
		array.push("");
	}
	
	if(queries[queryID] != null)
	{
		array.push(queries[queryID]);
	}
	else
	{
		array.push("");
	}
}

// ########### Actions ###########
function generateQueryList()
{
	var datString = genDataString();
	
	document.getElementById("hiddenFrame").src = "actions/do.createQueryList.php?dat="+escape(datString);
}

function loadBook()
{
	window.location = "loadBook.php";
}

function makeClass()
{
	  var datString = genDataString();
	 
	  document.getElementById("hiddenFrame").src = "actions/do.createClass.php?dat="+escape(datString);
}
function makeBook()
{
	var datString = genDataString();
	
	document.getElementById("hiddenFrame").src = "actions/do.createBook.php?dat="+escape(datString);
}
// ########### END Actions ###########