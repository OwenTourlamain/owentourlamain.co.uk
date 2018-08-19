var tempBasket = new Array();

function expandNav (nav, text) {
	nav.style.top = "0px";
	nav.style.boxShadow = "0 0 20px 5px black";
	text.innerHTML = "Hide";
}

function shrinkNav (nav, dist, text, value) {
	nav.style.top = dist + "em";
	nav.style.boxShadow = "0 0 0px 0px black";
	text.innerHTML = value;
} 

function toggleNav () {
	nav = document.getElementById("menu");
	text = document.getElementById("menuText");
	if (nav.style.top == "0px") {
		shrinkNav(nav, -16, text, "Menu");
	} else {
		expandNav(nav, text);
		nav2 = document.getElementById("settings");
		text2 = document.getElementById("settingsText");
		shrinkNav(nav2, -4, text2, "Settings");
	}
}

function toggleSettings () {
	nav = document.getElementById("settings");
	text = document.getElementById("settingsText");
	if (nav.style.top == "0px") {
		shrinkNav(nav, -4, text, "Settings");
	} else {
		expandNav(nav, text);
		nav2 = document.getElementById("menu");
		text2 = document.getElementById("menuText");
		shrinkNav(nav2, -16, text2, "Menu");
	}
}

function loginVal() {
	input = document.getElementById("loginBox");
	var username = input.value;
	if (username.length == 0) {
		input.placeholder = "Please enter a name";
		return false;
	} else {
		return true;
	}
}

function toggleAdvSearch() {
	div = document.getElementById("filter");
    child = div.getElementsByClassName('hide');
	if (div.style.width != "100%") {
		div.style.width = "100%";
		div.style.height = "8em";
		div.style.boxShadow = "0 0 5px 1px black";
		setTimeout(function() {
			for (i = 0; i < 10; i++) {
				child[i].style.display = "initial";
			}
		}, 500);
	} else {
		for (i = 0; i < 10; i++) {
			child[i].style.display = "none";
		}
		div.style.width = "20%";
		div.style.height = "4em";
		div.style.boxShadow = "0 0 0px 0px black";
	}
}

function addToBasket(img, id) {
	index = tempBasket.indexOf(id);
	if (index == -1) {
		tempBasket.push(id);
		basket = document.getElementById("postBasket");
		basket.value = tempBasket;
		img.style.backgroundColor = "#9B00B6";
	} else {
		tempBasket.splice(index, 1);
		basket = document.getElementById("postBasket");
		basket.value = tempBasket;
		img.style.backgroundColor = "#E5E5E5";
	}
}

function checkout() {
	if (tempBasket.length != 0) {
		document.forms['basketfrm'].submit();
	}
}
