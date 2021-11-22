function ValidateForm(frmObj) {
	var x = frmObj.elements.length;
	var message = "";
	var more_message = "";
	var	fldObj;
	var	req;
	var	reg;
	var	msg;
	var lbl;
	var mxl;
	var setfocus;
	var typ;
  	
	setfocus = "";
	
	for (var i = 0; i < x; i++) {
		fldObj = frmObj.elements[i];
		req = fldObj.getAttribute("vReq");
		reg = fldObj.getAttribute("vReg");
		msg = fldObj.getAttribute("vMsg");
		lbl = fldObj.getAttribute("vLbl");
		mxl = fldObj.getAttribute("vMxl");
		typ = fldObj.getAttribute("vTyp");
		
		if (req == null || reg == null) {
			continue;
		}
	
  		fldObj.className = fldObj.getAttribute("vClass");
	
		more_message = "";
    	if (req > 0) {
    	    more_message += ValidateRequired(fldObj, arrStrings.Scripts__Validation__Is_Required);
      	}
		if (mxl != null && mxl != "" && !isNaN(parseInt(mxl)) && parseInt(mxl) > 0) {
		  	more_message += ValidateFieldLength(fldObj);
		} 
		if (reg != null && reg != "") {
		  	more_message += ValidateField(fldObj);
		} 
		if (more_message != "" && (message == "")) {
         	message = more_message;
         	more_message="";
        } 
		else if (more_message != "") {
        	message = message + "\n" + more_message;
         	more_message="";
      	}
		if (req > 0) {
			if (setfocus.length < 1) {
				if (typ != null && typ != "list")
				{
					setfocus = fldObj;
				}
			}
		}
    }
	if (message > "") {
	    alert(arrStrings.Scripts__Validation__Field_Errors_1 + "\n\n" + message + "\n\n" + arrStrings.Scripts__Validation__Field_Errors_2);
	   
	   	if (setfocus != "")
		{
			setfocus.focus();
			setfocus = "";
		}
		return false;
		
   	}
	return true;
} 
 
function ValidateField(fldObj) {
	var	req = fldObj.getAttribute("vReq");
	var	reg = fldObj.getAttribute("vReg");
	var	msg = fldObj.getAttribute("vMsg");
	var	lbl = fldObj.getAttribute("vLbl");
	var typ = fldObj.getAttribute("vTyp");
	var msg_addition = "";
	var objRegExp = eval(reg);

	var form_field_value = fldObj.value;
   	if (typ == "date" && form_field_value != "") {
   	    msg_addition = ValidateDate(form_field_value) ? "" : lbl + " " + arrStrings.Scripts__Validation__Is_Not_A_Valid_Date + " " + msg;
   	} else if (typ == "range" && form_field_value != "") {
		msg_addition = ValidateRange(fldObj)?"":msg;
   	} else if (typ == "ip" && form_field_value != "") {
		msg_addition = ValidateIP(form_field_value)?"":msg;
	} else if (typ == "number" && form_field_value != "") {
		msg_addition = ValidateNumber(form_field_value,fldObj)?"":msg;
	//} else if (form_field_value != "" && (!objRegExp.test(form_field_value))) {
    //	msg_addition = lbl + " is not in a valid format " + msg;
	} else if (typ == "password" && form_field_value != "") {
		msg_addition = ValidatePassword(form_field_value)?"":msg;
	}
	
    if (msg_addition != ""){
  		fldObj.className = "invalidField";
	}
	
 	return msg_addition;
}

function ValidatePassword(password, specificMessage) {
    var lowerCase = ".*[a-z].*";
    var upperCase = ".*[A-Z].*";
    var digital = ".*[\\d].*";
    var checkPatternLowerCase = new RegExp(lowerCase);
    var checkPatternUpperCase = new RegExp(upperCase);
    var checkPatternDigital = new RegExp(digital);
    var valid = true;

    if (!checkPatternLowerCase.test(password)) {
        valid = false;
    }
    else if (!checkPatternUpperCase.test(password)) {
        valid = false;
    }
    else if (!checkPatternDigital.test(password)) {
        valid = false;
    }
    else if (password.length < 6) {
        valid = false;
    }
    else if (password.length > 16) {
        valid = false;
    }

    return valid;
}

function ValidateDate(dt) {
	var objRegExp = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/
	if (!objRegExp.test(dt)) {
		return false; //doesn't match pattern, bad date
	} else {
		var arrayDate = dt.split(RegExp.$1); //split date into month, day, year
		var intDay = parseInt(arrayDate[1],10); 
		var intYear = parseInt(arrayDate[2],10);
		var intMonth = parseInt(arrayDate[0],10);
		//check for valid month
		if(intMonth > 12 || intMonth < 1) {
			return false;
		}
		
		//create a lookup for months not equal to Feb.
		var arrayLookup = { '1' : 31,'3' : 31, '4' : 30,'5' : 31,'6' : 30,'7' : 31,
							'8' : 31,'9' : 30,'10' : 31,'11' : 30,'12' : 31}
		
		//check if month value and day value agree
		if(arrayLookup[intMonth] != null) {
		  if(intDay <= arrayLookup[intMonth] && intDay != 0)
			return true; //found in lookup table, good date
		}
			
		//check for February
		var booLeapYear = (intYear % 4 == 0 && (intYear % 100 != 0 || intYear % 400 == 0));
		if (((booLeapYear && intDay <= 29) || (!booLeapYear && intDay <=28)) && intDay !=0)
		  return true; //Feb. had valid number of days
		
		return false;
	}
}

function ValidateRange(fldObj) {
	var	vMin = parseFloat(fldObj.getAttribute("vMin"));
	var	vMax = parseFloat(fldObj.getAttribute("vMax"));
	
	if (isNaN(fldObj.value)) return false;
	var form_field_value = parseFloat(fldObj.value);
	return (form_field_value >= vMin && form_field_value <= vMax)
}

function ValidateIP(ip) {
	var re = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
	if (re.test(ip)) {
		var parts = ip.split(".");
		if (parseInt(parseFloat(parts[0])) == 0) { return false; }
		for (var i=0; i<parts.length; i++) {
			if (parseInt(parseFloat(parts[i])) > 255) { return false; }
		}
		return true;
	} else {
		return false;
	}
}

//strips out spaces and commas from numbers
function ValidateNumber(string,fldObj) 
	{
		var temp = "";
		var aLocalString;
		var aFinalString;
		aLocalString = string;
		
		removespace = aLocalString.replace(/\s/g, "");
		aFinalString = removespace.replace(/[^0123456789.]/g, "");
		
		//Check if there is more than one decimal
		string = aFinalString;
		DecCount = string.match(/\b.\b/g);
		DecCount = string.replace(/\d+/g, "");
		if (DecCount != "")
		{
			if (DecCount.length > 1)
			{
			alert(arrStrings.Scripts__Validation__Error_Decimal_Multiple_Point);
			}
		}
		fldObj.value = aFinalString;
		return aFinalString;
		
	}

function ValidateFieldLength(fldObj) {
	var	msg = fldObj.getAttribute("vMsg");
	var	lbl = fldObj.getAttribute("vLbl");
	var mxl = parseInt(fldObj.getAttribute("vMxl"));
	var msg_addition = "";
	form_field_value = TRIM(fldObj.value);
    if (form_field_value.length > mxl) {
    	msg_addition = msg;
   	}
 	return msg_addition;
}
 
function ValidateRequired(fldObj,msg) {
    msg_addition = "";
   	var strTemp = fldObj.value
	strTemp = TRIM(strTemp);
    if(strTemp.length == 0){
    	//Before concluding invalidity, check try to validate as a rating scale.
    	if (!IsRatingValid(fldObj))
    	{
    		//Not a rating field, or rating field invalid.
    		msg_addition = fldObj.getAttribute('vLbl')+' '+msg;
  			fldObj.className = "requiredField";
  		}
	}
	return (msg_addition);
}

function IsRatingValid(fldObj)
{
	var listIndicator = "List_";
	if (fldObj.name.indexOf(listIndicator) == -1)
	{
		return false;
	}

	//If we got here, it's a list. Check if it's a rating scale by searching for a Children_[listid] object
	var listId = fldObj.name.substring(listIndicator.length);
	var childrenId = "Children_" + listId;
	var childrenObj = document.getElementById(childrenId);
	if (!childrenObj)
	{
		return false;
	}

	//Check if each child (question) has a valid input (answer radio that's checked)
	var childrenListStr = childrenObj.value;
	var childrenList = childrenListStr.split(",");
	for (var i = 0; i < childrenList.length; i++)
	{
		var childId = childrenList[i];
		if (!isRadioGroupChecked("RegSubField_" + childId))
		{
			return false;
		}
	}

	//If we got here it means this field is indeed a rating scale field and all questions are answered
	return true;
}

function isRadioGroupChecked(radioGroupName)
{
    var radios = document.getElementsByName(radioGroupName);
	for (var i = 0; i < radios.length; i++) 
	{
          if (radios[i].checked) 
          {
              return true;
          }
     }

     return false;
 }

function removeCurrency( strValue ) {
  var objRegExp = /\(/;
  var strMinus = "";
  var strValue = strValue.replace(",","");
  objRegExp = /\)|\(|[,]/g;
  strValue = (strValue)? strValue.replace(objRegExp,''):'';
  if(strValue.indexOf('$') >= 0){
    strValue = strValue.substring(1, strValue.length);
  }
  return strValue;
}

function TRIM(strValue) {
  var objRegExp = /^(\s*)$/;
    if(objRegExp.test(strValue)) {
       strValue = strValue.replace(objRegExp, '');
       if( strValue.length == 0)
          return strValue;
    }
   //check for leading & trailing spaces
   objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
   if(objRegExp.test(strValue)) {
       //remove leading and trailing whitespace characters
       strValue = strValue.replace(objRegExp, '$2');
    }
  return strValue;
}

function InitValidation(frmName,fldArr,realTimeValidation) {
	var frmObj = document.forms[frmName];
	
	if (document.all) {
		window.attachEvent("onload",function() {setUpForm(frmObj,fldArr,realTimeValidation);});
		frmObj.attachEvent("onsubmit", function() {return ValidateForm(frmObj)});
	} else {
		window.addEventListener("load",function(e) {setUpForm(frmObj,fldArr,realTimeValidation);}, true);
		frmObj.onsubmit = function() {return (ValidateForm(frmObj));};
	}
}

function setUpForm(frmObj,fldArr,realTimeValidation) {

	//Let's add our global DIV to handle the real time validation (bubble help)
	var vBubble = document.getElementById("vBubble");
	if (vBubble == null) {
		vBubble = document.createElement("DIV");
		vBubble.id = "vBubble";
		vBubble.className = "ValidationBubble";
		document.body.appendChild(vBubble);
	}
	for (var i=0;i<fldArr.length;i++) {
		var fldObj = frmObj.elements[fldArr[i]["field"]];
		if (!fldObj) {
			continue;
		}
		
		fldObj.setAttribute("vReq",fldArr[i]["required"]);
		fldObj.setAttribute("vMsg",fldArr[i]["message"]);
		fldObj.setAttribute("vLbl",fldArr[i]["label"]);
		fldObj.setAttribute("vTyp",fldArr[i]["vType"]);

		if (fldArr[i]["min"] != "") fldObj.setAttribute("vMin",fldArr[i]["min"]);
		if (fldArr[i]["max"] != "") fldObj.setAttribute("vMax",fldArr[i]["max"]);
		if (fldArr[i]["minLength"] != "") fldObj.setAttribute("vMnl",fldArr[i]["minLength"]);

		if (fldArr[i]["maxLength"] != "" && fldArr[i]["maxLength"] > 0) {
			fldObj.setAttribute("vMxl",fldArr[i]["maxLength"]);
		}
		fldObj.setAttribute("vReg",fldArr[i]["regex"]);
		//fldObj.setAttribute("title",fldArr[i]["message"]);

		//set up onblur events for field
		if (realTimeValidation) {
			if (document.all) {
				fldObj.attachEvent("onblur",function() {CheckField(window.event);});
				fldObj.attachEvent("onfocus",function() {HintField(window.event);});
			} else {
				fldObj.addEventListener("blur", function(e) {CheckField(e)},true);
				fldObj.addEventListener("focus",function(e) {HintField(e);},true);
			}

		} else {
			fldObj.setAttribute("title",fldArr[i]["message"]);
		}
		
		if (fldObj.className != null) fldObj.setAttribute("vClass",fldObj.className);
		else fldObj.setAttribute("vClass","");
	}
	
}

function HintField(e) {
	var fldObj = (document.all)?e.srcElement:e.target;
	//fldObj.className = fldObj.getAttribute("vClass");
	var msg = fldObj.getAttribute("vMsg");
	var pos = getAbsolutePosition(fldObj);	
	var vBubble = document.getElementById("vBubble");
	vBubble.style.left = pos["x"]+fldObj.offsetWidth;
	vBubble.style.top = pos["y"];
	vBubble.innerHTML = msg+"&nbsp;<br>&nbsp;";
// commented and just displayed on page for right now
//	if (msg != '')
//	{
//		vBubble.style.display = "block";
//	}
//	else
//	{
//		vBubble.style.display = "none";
//	}
}

function getAbsolutePosition(elObj) {
	var o = elObj;
	var oLeft = o.offsetLeft            // Get left position from the parent object
	var posArr = new Array();
	while(o.offsetParent!=null) {   // Parse the parent hierarchy up to the document element
		oParent = o.offsetParent;    // Get parent object reference
		oLeft += oParent.offsetLeft; // Add parent left position
		o = oParent;
	}
	// Return left postion
	posArr["x"] = oLeft;
	
	var o = elObj;
	oTop = o.offsetTop;           // Get top position from the parent object
	while(o.offsetParent!=null) { // Parse the parent hierarchy up to the document element
		oParent = o.offsetParent;  // Get parent object reference
		oTop += oParent.offsetTop; // Add parent top position
		o = oParent;
	}
	posArr["y"] = oTop;
	// Return top position
	return posArr;

}

function CheckField(e) {
	var fldObj = (document.all)?e.srcElement:e.target;
	var msg = ValidateField(fldObj);

	/*
	if (msg != "") {
		if (window.confirm(msg)) {
			fldObj.focus(); 
		} else {
			fldObj.blur();
		}
	}
	*/
}


function filterNum(str) {
     re = /\$|,|@|#|~|`|\%|\*|\^|\&|\(|\)|\+|\=|\[|\-|\_|\]|\[|\}|\{|\;|\:|\'|\"|\<|\>|\?|\||\\|\!|\$|\./g;
     // remove special characters like "$" and "," etc...
     return str.replace(re, "");
}
