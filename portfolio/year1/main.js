var uName = "";			
var btn = document.getElementById('btn_submit');
var txtIn = document.getElementById('txt_input');
var txtOut = document.getElementById("p_output");
var sel = document.getElementById("sel_colour");
var lastModifiedPos = document.getElementById("ft_center");

var light = "./style/light.css";
var dark = "./style/dark.css";
var fire = "./style/fire.css";
var ice = "./style/ice.css";
var grass = "./style/grass.css";
var sepia = "./style/sepia.css";

function onLoad() {
	uName = getCookieVal("username");
	if (uName != 0) {
		setGreeting(uName);
	}
	var css = getCookieVal("css");
	if (css != 0) {
		setCSS(css);
	} else {
		setCSS(light);
	}
	
	var lastMod = new Date(document.lastModified);
	lastModifiedPos.innerHTML = "Page last modified on: "+lastMod.toLocaleString();
}

function btn_submit() {
	var input = txtIn.value;
	if (btn.innerHTML == "Submit") {
		if (input != "") {
			setGreeting(input);
			document.cookie="username="+input;
		}
	} else {
		resetGreeting();
	}
}

function setGreeting (name) {
	var date = new Date();
	if (date.getHours() > 18) {
		txtOut.innerHTML = "Good evening " + name + ".";
	} else if (date.getHours() > 11) {
		txtOut.innerHTML = "Good afternoon " + name + ".";
	} else {
		txtOut.innerHTML = "Good morning " + name + ".";
	}
	btn.innerHTML = "Clear";
	txtIn.style.display = "none";
}

function resetGreeting () {
	txtOut.innerHTML = "";
	txtIn.value = "";
	txtIn.style.display = "inline";
	btn.innerHTML = "Submit";
	document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
}

function setCSS(cssFile) {
	/*
		Based (heavily) on code taken from: http://www.omnimint.com/A6/JavaScript/Change-external-CSS-stylesheet-file-with-JavaScript.html
	*/
	var oldlink = document.getElementsByTagName("link").item(0);
	var newlink = document.createElement("link");
	
	newlink.setAttribute("rel", "stylesheet");
	newlink.setAttribute("type", "text/css");
	newlink.setAttribute("href", cssFile);
	document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink);
}

function getCookieVal(cookieName) {
	/*
		Code taken from: http://www.javascriptworld.com/js6e/chap10-6.html
	*/
	var thisCookie = document.cookie.split("; ");
	
	for (var i=0; i<thisCookie.length; i++) {
		if (cookieName == thisCookie[i].split("=")[0]) {
			return thisCookie[i].split("=")[1];
		}
	}
	return 0;
}

function sel_colour() {
	var css = sel.options[sel.selectedIndex].text;
	
	switch(css) {
		case "Light":
			setCSS(light);
			document.cookie = "css="+light;
			break;
		case "Dark":
			setCSS(dark);
			document.cookie = "css="+dark;
			break;
		case "Fire":
			setCSS(fire);
			document.cookie = "css="+fire;
			break;
		case "Ice":
			setCSS(ice);
			document.cookie = "css="+ice;
			break;
		case "Grass":
			setCSS(grass);
			document.cookie = "css="+grass;
			break;
		case "Sepia":
			setCSS(sepia);
			document.cookie = "css="+sepia;
			break;
	}
}

window.onload = onLoad;