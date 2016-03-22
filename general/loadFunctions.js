// JavaScript Document
function loadQuery(sectionID,name,note,sql)
{
	htmlEnt = document.getElementById(sectionID);
	
	nSections++;
	
	var divID = "query"+nSections;
	
	var nd = document.createElement("div");
	
	htmlEnt.parentNode.appendChild(nd);

	nd.setAttribute("class","subItem");
	
	nd.setAttribute("onclick","selectElement('"+divID+"')");
	
	nd.innerHTML = "<div class='subMinus'>-</div><span class='queryName' id='"+divID+"' onmouseover='changeElementColor(this)' onmouseout='changeElementColorBack(this)' onclick='selectElement('"+divID+"')' >"+name+"</span>";
	
	htmlEnt.parentNode.appendChild(nd);
	
	loadNote(divID, note);
	loadSql(divID, sql);
}

function loadSql(id, sql)
{
	queries[id] = sql; 
}

function loadNote(id, content)
{
	notes[id] = content; 
}

function loadSection(name,note)
{
	nSections++;
	
	document.getElementById("itemNav").innerHTML += "<div id='navElm"+ (nSections) +"' class='navElement'><div onclick='expandSection(this)' class='expandPlus'>+</div><span id='sectionHead"+ (nSections) +"' onclick='selectElement(\"sectionHead"+ (nSections) +"\")' onmouseout='changeElementColorBack(this)' onmouseover='changeElementColor(this)' class='sectionTitle'>"+name+"</span></div>";

	loadNote("sectionHead"+ nSections, note);
	
	return ("sectionHead"+ nSections);
	
}