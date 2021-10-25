// JavaScript Document
// to prevent bots
function CheckForDisplay()
{
	document.getElementById("check_fields_here").style.display = "none";	
}

function CheckThisForErrors()
{
	document.getElementsByName("RegSubField_0001")[0].value = "Adam is checking this for errors";
}