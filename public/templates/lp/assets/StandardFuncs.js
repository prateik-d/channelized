function embed(tagvalue)
{
	document.write(tagvalue);
}

// Creates the standard http call for Ajax functions
function getHTTPObject() 
{
	var xmlhttp;
	
	/*@cc_on
	
		@if (@_jscript_version >= 5)
		
		try {
		
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		
		} catch (e) {
		
		try {
		
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
		} catch (E) {
		
		xmlhttp = false;
		
		}
		
		}
		
		@else
		
		xmlhttp = false;
	
	@end @*/
	
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
	{
		try 
		{
			xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			xmlhttp = false;
		}
	}
	
	return xmlhttp;
}

var http = getHTTPObject(); // We create the HTTP Object

// capture the mouse location
var IE = document.all?true:false;
if (!IE) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;

function getMouseXY(e) 
{
	if (IE) 
	{ // grab the x-y pos.s if browser is IE
		if (!document.body)
		{
			return true;
		}
		
		tempX = event.clientX + document.body.scrollLeft;
		tempY = event.clientY + document.body.scrollTop;
	}
	else 
	{  // grab the x-y pos.s if browser is NS
		tempX = e.pageX;
		tempY = e.pageY;
	}  
	if (tempX < 0){tempX = 0;}
	if (tempY < 0){tempY = 0;}  
	return true;
}

function getPageSizeWithScroll(){
	if (window.innerHeight && window.scrollMaxY) {// Firefox
		yWithScroll = window.innerHeight + window.scrollMaxY;
		xWithScroll = window.innerWidth + window.scrollMaxX;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		yWithScroll = document.body.scrollHeight;
		xWithScroll = document.body.scrollWidth;
	} else { // works in Explorer 6 Strict, Mozilla (not FF) and Safari
		yWithScroll = document.body.offsetHeight;
		xWithScroll = document.body.offsetWidth;
  	}
	arrayPageSizeWithScroll = new Array(xWithScroll,yWithScroll);
	//alert( 'The height is ' + yWithScroll + ' and the width is ' + xWithScroll );
	return arrayPageSizeWithScroll;
}

//the two functions below let you find the x,y coordinates of any html element, you just 
//need to pass in the object.
function findPosX(obj)
{
  var curleft = 0;
  if(obj.offsetParent)
      while(1) 
      {
        curleft += obj.offsetLeft;
        if(!obj.offsetParent)
          break;
        obj = obj.offsetParent;
      }
  else if(obj.x)
      curleft += obj.x;
  return curleft;
}

function findPosY(obj)
{
  var curtop = 0;
  if(obj.offsetParent)
      while(1)
      {
        curtop += obj.offsetTop;
        if(!obj.offsetParent)
          break;
        obj = obj.offsetParent;
      }
  else if(obj.y)
      curtop += obj.y;
  return curtop;
}


function ReplaceNumbers(sw_root)
{
	// check if span exists on the page
	var SpansTest = getElementsByClassName("callus", "span")
	if (SpansTest.length==0)
	return false;
 
	// get the session id from the cookie
	SessionCookie = ReadCookie("SWSESSIONID");

	// get the session id from the cookie
	SessionCookie = ReadCookie("SWSESSIONID");
	// see if we have campaign ID parameter, use it if we do!
	urlStr = window.location.search.substring(1);
	sv = urlStr.split("&");
	campStr = "";
	for (i = 0; i < sv.length; i++) {
	    ft = sv[i].split("=");
	    st0 = ft[0].toString();
	    if (st0.toLowerCase() == 'swcampaignid') {
	        camp = ft[1].toString();
	        campStr = "&swcampaignid=" + camp;
	        break;
	    }
	}

	var url = "/" + sw_root + "/swchannel/GetVSNumbers.asp?SWSESSIONID=" + SessionCookie + "&ms=" + new Date().getTime() + campStr;
    	
    var xmlhttp=false; //declare the httpxml and create object with browser sensitivity;	
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			xmlhttp=false;
		}
	}
	if (!xmlhttp && window.createRequest) {
		try {
			xmlhttp = window.createRequest();
		} catch (e) {
			xmlhttp=false;
		}
	}
	
	xmlhttp.open("GET", url, true);
		
	 xmlhttp.onreadystatechange  = function()
			{ 
			     if(xmlhttp.readyState  == 4)
			     {
			          if(xmlhttp.status  == 200) 
			             changeSpansNumbers(xmlhttp.responseText);
			     }
			}; 

	//alert(url);
	if (parseInt(navigator.appVersion)>3) {
	 if (navigator.appName=="Netscape") {
    	  xmlhttp.send(''); // Firefox
	 }
	 if (navigator.appName.indexOf("Microsoft")!=-1) {
    	  xmlhttp.send(null); // IE (6 and 7)
	 }
	}
	
}

function changeSpansNumbers(NumberDisplay) 
{
	
	if (NumberDisplay.length>0)
	{
		var Spans = getElementsByClassName("callus", "span")
		for(var i = 0; i < Spans.length; i++) 
		{
		   
		      Spans[i].innerHTML = NumberDisplay;
		}
	}
}


/* call to ss-pika JS function to show ss-pika icons, usually this needs to be done in old versions of IE for when data is fetched via JS that may have the ss-pika icons */
function reloadIcons() {
    if(typeof ss_legacy !== "undefined"){
	    //if we have an older browser which doesn't have the getElementsByClassName feature (i.e. IE8)
	    if (!document.getElementsByClassName) {
	        ss_legacy(ss_getElementsByClassName(document.body, 'ss-icon'));
	    } else {
	        ss_legacy(document.getElementsByClassName('ss-icon'));
	    }
	}
}   
    
/*
	Developed by Robert Nyman, http://www.robertnyman.com
	Code/licensing: http://code.google.com/p/getelementsbyclassname/
*/	
var getElementsByClassName = function (className, tag, elm){
	if (document.getElementsByClassName) {
		getElementsByClassName = function (className, tag, elm) {
			elm = elm || document;
			var elements = elm.getElementsByClassName(className),
				nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
				returnElements = [],
				current;
			for(var i=0, il=elements.length; i<il; i+=1){
				current = elements[i];
				if(!nodeName || nodeName.test(current.nodeName)) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	else if (document.evaluate) {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = "",
				xhtmlNamespace = "http://www.w3.org/1999/xhtml",
				namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
				returnElements = [],
				elements,
				node;
			for(var j=0, jl=classes.length; j<jl; j+=1){
				classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
			}
			try	{
				elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
			}
			catch (e) {
				elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
			}
			while ((node = elements.iterateNext())) {
				returnElements.push(node);
			}
			return returnElements;
		};
	}
	else {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = [],
				elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
				current,
				returnElements = [],
				match;
			for(var k=0, kl=classes.length; k<kl; k+=1){
				classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
			}
			for(var l=0, ll=elements.length; l<ll; l+=1){
				current = elements[l];
				match = false;
				for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
					match = classesToCheck[m].test(current.className);
					if (!match) {
						break;
					}
				}
				if (match) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	return getElementsByClassName(className, tag, elm);
}

function extractCookieValue(val) {
  if ((endOfCookie = document.cookie.indexOf(";", val)) == -1) {
     endOfCookie = document.cookie.length;
  }
  return unescape(document.cookie.substring(val,endOfCookie));
}

function ReadCookie(cookiename) {
  var numOfCookies = document.cookie.length;
  var nameOfCookie = cookiename + "=";
  var cookieLen = nameOfCookie.length;
  
  var x = 0;
  while (x <= numOfCookies) {
        var y = (x + cookieLen);                
        if (document.cookie.substring(x, y) == nameOfCookie)
           return (extractCookieValue(y));
           x = document.cookie.indexOf(" ", x) + 1;
           if (x == 0){
              break;
           }
  }
  return (null);
}

function WriteCookie(name, value, days)
{
	var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
	document.cookie = name + "=" + value + expires + "; path=/";
}

function DeleteCookie(name){
	WriteCookie(name, "", -1);
}

function DisableAllLinks()
{
	var allLinks = document.getElementsByTagName('a');
	
	for(i = 0; i < allLinks.length; i++) 
	{
		var aElem = allLinks[i]; 
		allLinks[i].href = '#';
		allLinks[i].onclick = '';
	}
	
	var allTabs = document.getElementsByTagName('table');
	
	for(i = 0; i < allTabs.length; i++) 
	{
		var aElem = allTabs[i]; 
		allTabs[i].onclick = '';
	}
}


function ToggleDropDowns(DivID)
{
	IsOpen = eval('document.getElementById("' + DivID + '").style.display');
	
	if (IsOpen == "block")
	{
		eval('document.getElementById("' + DivID + '").style.display = "none"');
	}
	else
	{
		eval('document.getElementById("' + DivID + '").style.display = "block"');
	}
}

function disableFormSubmit(e)
{
	
	if(window.event)	//IE  and chrome
	{
		if(event.keyCode == 13) {
			return false;
		}
		else{
			return true;
		}
	}
	else if(e.which) 	//Other Browsers
	{						
		if(e.which == 13) {
			return false;
		}
		else {
			return true;
		}
	}
}

<!---also in .net--->
function addUrlParameters(url, parameters) {
	if (parameters.length % 2 == 0) {
		var seperator = '?';
		if (url.indexOf('?') != -1) {
			seperator = '&';
		}
		
		for(var i=0;i<parameters.length; i=i+2){
			url += seperator + parameters[i] + '=' + parameters[i + 1];
			seperator = '&';
		}
	}
	return url;
}

function isIEEight(){
	var ieIndex = document.getElementsByTagName("html")[0].className.indexOf("ie8");
	return ieIndex != -1;
}

//sets a style property 
function setStyle(element, styleProperty, styleValue){
	if(element.style.setProperty)
	{
		//modern browser way
		element.style.setProperty(styleProperty,styleValue);
	}
	else
	{
		//old browser
		if(element.style.styleProperty){
			element.style.styleProperty = styleValue;
		}
	}
}
var ButtonsClicked = new Array();
function NoReClick(element,foo, id)
{
	if(ButtonsClicked[id])
	{
		return ;
	}

	ButtonsClicked[id] = true;
	if(element){
		//set the clicked element to be disabled
		element.disabled = true;
	}
	foo();
}

function EnableReClick(id) {
	ButtonsClicked[id] = false;
	var ele = document.getElementById(id);
	if(ele) {
		ele.disabled = false;
	}
}

function ReEnableButton(id)
{
	ButtonsClicked[id] = false;
	document.getElementById(id).disabled = false;
}

/*Popup functions*/
function ChangePopUpTitle(PopupID, newTitle)
{
	var titleId = "popUpTitle" + PopupID;
	document.getElementById(titleId).innerHTML = newTitle;
}

function KillPopUp(PopupID)
{
	var popup = "popUp" + PopupID;
	document.getElementById(popup).style.display = "none";
}

function ShowPopUp(PopupID, width)
{
	width = (typeof width !== 'undefined') ?  width : 85;
	var popup = "popUp" + PopupID;
	var unit = "%";
	if(typeof width === "number"){
		if(width > 100){
			unit = "px";
		}
	}else if(typeof width ==="string"){
		unit = "";
	}
	document.getElementById(popup).style.display = "block";
	document.getElementById(popup).style.width = width + unit;
}

function ShowPopUpSocial(PopupID, width, top, left)
{
	width = (typeof width !== 'undefined') ?  width : 85;
	var popup = "popUp" + PopupID;
	var unit = "%";
	if(typeof width === "number"){
		if(width > 100){
			unit = "px";
		}
	}else if(typeof width ==="string"){
		unit = "";
	}
	document.getElementById(popup).style.display = "block";
	document.getElementById(popup).style.width = width + unit;
	document.getElementById(popup).style.top = top;
	document.getElementById(popup).style.left = left;
}

function IsPopUpVisible(popupId){
	var popup = "popUp" + popupId;
	return document.getElementById(popup).style.display === "block";
}
/* End of popup functions */


//checks if an element has a classname
function hasClass(el, className) {
    if (el.classList instanceof DOMTokenList) {
        return el.classList.contains(className);
    }
    else {
        return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
    }
}

//removes a class from an element
function removeClass(el, className) {
    if (el.classList instanceof DOMTokenList) {
        el.classList.remove(className);
    }
    else {
        el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    }
}

//adds a class to an element
function addClass(el, className) {
    if (el.classList instanceof DOMTokenList) {
        el.classList.add(className);
    }
    else {
        el.className += ' ' + className;
    }
}
//percent should be a number between 0 and 100
function updateProgressBar(barId, percent){
	var bar = document.getElementById(barId);
	bar.style.width = percent + "%";
	if(bar.parentNode){
		bar.parentNode.title = percent + "%";
	}
}

//utility function: gets a data-{attrName} attribute from the element passed in
//wraps jquery because i don't feel like dealing with all browser edge cases right now
function getDataAttribute(ele, attrName) {
    return $(ele).data(attrName);
}

function goBack(){
	window.history.back();
}

//validates that one item in a list of radios/checkboxes is checked
function validateRadio(radioNodes) {
    for (var i = 0; i < radioNodes.length; i++) {
        if (radioNodes[i].checked) {
            return true;
        }
    }
    return false;
}

//cross-browser wrapper to add an event listener to an element
//evnt=eventname, elem=element, func= callback function
//IE does not support addEventListener...
function addEvent(evnt, elem, func) {
	if (elem.addEventListener) { // W3C DOM
		elem.addEventListener(evnt, func, false);
	} else if (elem.attachEvent) { // IE DOM
		elem.attachEvent("on" + evnt, func);
	}
}
//also in global.js
function copyToClipboard(txtAreaName) {
    var textArea = document.getElementById(txtAreaName);
    textArea.select();
    try {
        var successful = document.execCommand('copy');
        return successful;
    }
    catch (err) {
        return false;
    }
}

function copyToClipboardShowMessageAndHide(txtAreaName, elementToHide, successSelector, timeout) {
    if(typeof timeout ==="undefined"){
    	timeout = 3000;
    }
    if (copyToClipboard(txtAreaName)) {
        if (typeof elementToHide === "string") {
            elementToHide = document.getElementById(elementToHide);
        }

        setTimeout(function timeoutFunc() {
            hideElement(elementToHide);
            $(successSelector).addClass("sw-hide");
        }, timeout);
        $(successSelector).removeClass("sw-hide");        
    }
}

function copyToClipboardAndClose(txtAreaName, elementToHide) {
    if (copyToClipboard(txtAreaName)) {
        if (typeof elementToHide === "string") {
            elementToHide = document.getElementById(elementToHide);
        }
        hideElement(elementToHide);
    }
}
function hideElement(ele) {
	if (ele) {
		ele.style.display = "none";
	}
}
function showElement(ele) {
	if (ele) {
		ele.style.display = "block";
	}
}
function getIframeDocument(iframeObj){
	var theDoc = iframeObj.contentWindow || iframeObj.contentDocument;
	if(theDoc.document){
		theDoc = theDoc.document;
	}
	return theDoc;
}
//used to get the true height/width of the page inside an iframe
function getIframeSize(iframeObj){
	var d = getIframeDocument(iframeObj);
	var hz = Math.max(
				Math.max(d.documentElement.scrollHeight, d.body.scrollHeight), 
				Math.max(d.documentElement.offsetHeight, d.body.offsetHeight),
				Math.max(d.documentElement.clientHeight, d.body.clientHeight)
			);
	var wd = Math.max(
				Math.max(d.documentElement.scrollWidth, d.body.scrollWidth),
				Math.max(d.documentElement.offsetWidth, d.body.offsetWidth),
				Math.max(d.documentElement.clientWidth, d.body.clientWidth)
			);
	return {height: hz, width: wd};
}

function iframeAutoSize(ifr){
	var doc = getIframeDocument(ifr);
	var size = getIframeSize(ifr)
	if(size.height > 0){
		ifr.style.height = size.height + "px";
	}
	if(size.width > 0){
		ifr.style.width = size.width + "px";
	}
}


//loops over functions in given object 
//and adds the functions to the attachee
function attach(attachee, obj){
	for(var prop in obj){
		if(attachee.hasOwnProperty(prop)){
			throw "name collision with property: " + prop;
		}
		if(obj.hasOwnProperty(prop) && typeof obj[prop] === "function"){
			attachee[prop] = obj[prop];
		}

	}
}

function clearCKEditorDirtyFlag() {
	// We have to try this. Sometimes these pages load	
	// without any CKEditor's on the page. If this code is called on the validate method
	// when no editor exists, pages freeze/crash when the JS fails
	try	{
		//SW-6072
	    var editorInstance = Object.keys(CKEDITOR.instances)[0]
	    var ckBool = CKEDITOR.instances[editorInstance].resetDirty();
	} catch(error) {
		//and do nothing with it
	}
	return ckBool;
}

function clearDirtyFlagandSubmitForm(form) {
	clearCKEditorDirtyFlag();
	var theForm = document.getElementsByName(form)[0];		
	theForm.submit();
}


function checkCKEditorDirtyFlag() {
    var editorInstance = Object.keys(CKEDITOR.instances)[0]
    return CKEDITOR.instances[editorInstance].checkDirty();
}


//on occasion Templates will be blank and not have a CKEditor
//If the JS function checking or clearing the CKEditor flag fails, then use these functions instead
//Used in TemplateView.cfm Preview Button Popups to avoid having the button do nothing

function checkTemplateCKEditorDirtyFlag() {
    
    try {
    	var editorInstance = Object.keys(CKEDITOR.instances)[0]
    	var x = CKEDITOR.instances[editorInstance].checkDirty();
    } catch(e){ 
    	//do nothing 
    }
    return x;
}