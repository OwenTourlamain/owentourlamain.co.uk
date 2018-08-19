//copyright ©, Owen Tourlamain - Whodok Games, 2014
//Version: 1.0
//Date Modified: 01/06/2014

//Orbits
var starX;
var starY;
var starRadius = 30;
var planets = [];
var background = [];
var gameOver = false;
var logo_img = document.getElementById("logo_img");

//Dynamic content
var about_div = document.getElementById("about_div");
var games_div = document.getElementById("games_div");
var blog_div = document.getElementById("blog_div");
var contact_div = document.getElementById("contact_div");
var holder_div = document.getElementById("holder_div");
var currentTab = "none";

//Orbits
function init() {
	canvas = document.getElementById('canvas');
	ctx = canvas.getContext('2d');
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	clear_canvas();
	starX = 100;
	starY = 400;
	create_planets(Math.ceil(Math.random() * 3 + 6));
	create_background(Math.ceil(Math.random() * 60 + 60));
	frameRate = 30;
	frameTimer = 1000 / frameRate;

	game_loop();
}

function game_loop() {
	clear_canvas();
	draw_star();
	draw_background();
	move_planets();
	draw_planets();

	if (!gameOver) {
		game = setTimeout("game_loop()", frameTimer);
	}
}

function clear_canvas() {
	ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function create_background(num) {
	for (var i=0; i<num; i++) {
		var X = Math.ceil(Math.random() * canvas.width);
		var Y = Math.ceil(Math.random() * (canvas.height * 3));
		var f = (Math.random() + 0.3) / 2;
		var r = (Math.random() + 1) * 2;
		background.push({
			x: X,
			y: Y,
			radius: r,
			fade: f
		});
	}
}

function draw_background() {
	for (var i = 0; i<background.length; i++) {
		var thisStar = background[i];
		ctx.beginPath();
		ctx.arc(thisStar.x, thisStar.y, thisStar.radius, 0, Math.PI*2, false);
		var grd = ctx.createRadialGradient(thisStar.x, thisStar.y, 1, thisStar.x, thisStar.y, thisStar.radius);
		grd.addColorStop(0, "rgba(255, 255, 255, " + thisStar.fade + ")");
		grd.addColorStop(1, "rgba(0, 0, 0, 0)");
		ctx.fillStyle = grd;
		ctx.fill();
		ctx.closePath();
	}
	
	this.offsetTop + ( this.offsetParent ? this.offsetParent.documentOffsetTop : 0 );
}

function draw_star() {
	ctx.beginPath();
	ctx.arc(starX, starY, starRadius, 0, Math.PI*2, false);
	ctx.closePath();

	// create radial gradient
	var grd = ctx.createRadialGradient(starX, starY, 5, starX, starY, starRadius);
	grd.addColorStop(0, "#fff");
	grd.addColorStop(.6, "#dd0");
	grd.addColorStop(.8, "rgba(255, 160, 0, 0.5)");
	grd.addColorStop(1, "rgba(255, 255, 255, 0.05)");
	ctx.fillStyle = grd;
	ctx.fill();
}

function create_planets(num) {
	var limit = canvas.width / 2 - 50;
	var previousRadius = 0;
	var previousMagnitude = 0;
	var minDistance = 20;
	for (var i=0; i<num; i++) {
		// further planets tend to be larger
		pRadius = Math.ceil(Math.random() * 6) + ((i+2) * 2);
		if (i>0) {
			previousRadius = planets[i-1].radius;
			previousMagnitude = planets[i-1].magnitude;
		}
		var rand = Math.ceil(Math.random() * ((limit - previousMagnitude) / (num - i)));
		var magnitude = previousMagnitude + previousRadius + pRadius + minDistance + rand;
		if (magnitude < (starRadius + pRadius + 60)) magnitude = starRadius + pRadius + 60;
		var ang = Math.random() * 2 * Math.PI;
		var nX = Math.cos(ang) * magnitude + starX;
		var nY = Math.sin(ang) * magnitude + starY;
		var speed = deg2rad(Math.random()+.1);
		var r = (Math.ceil(Math.random() * 7) + 2);
		var g = (Math.ceil(Math.random() * 7) + 2);
		var b = (Math.ceil(Math.random() * 7) + 2);
		var color = "#" + String(r) + String(g) + String(b);
		
		var moon = Math.random();
		var moonR = Math.ceil(Math.random() * 2) + 2;
		if (moonR > pRadius) {
			moonR = pRadius;
		}
		var minMDistance = pRadius + 5;
		var moonM = moonR + minMDistance + Math.ceil(Math.random() * (pRadius * 3));
		var angM = Math.random() * 2 * Math.PI;
		var mX = Math.cos(angM) * moonM + nX;
		var mY = Math.sin(angM) * moonM + nY;
		var mSpeed = deg2rad(Math.random()+2);
		var mr = (Math.ceil(Math.random() * 7) + 2);
		var mg = (Math.ceil(Math.random() * 7) + 2);
		var mb = (Math.ceil(Math.random() * 7) + 2);
		var mColor = "#" + String(mr) + String(mg) + String(mb);
		planets.push({
			magnitude: magnitude,
			angle: ang,
			x: nX,
			y: nY,
			radius: pRadius,
			speed: speed,
			color: color,
			hasMoon: moon,
			moonMag: moonM,
			moonRad: moonR,
			moonX: mX,
			moonY: mY,
			moonAng: angM,
			moonSpd: mSpeed,
			moonColor: mColor
		});
	}
}

function move_planets() {
	for (var i = 0; i<planets.length; i++) {
		var thisPlanet = planets[i];
		thisPlanet.angle += thisPlanet.speed;
		if (thisPlanet.angle > Math.PI * 2) { planets[i].angle = 0; }
		thisPlanet.x = Math.cos(thisPlanet.angle) * thisPlanet.magnitude + starX;
		thisPlanet.y = Math.sin(thisPlanet.angle) * thisPlanet.magnitude + starY;
		if (thisPlanet.hasMoon > 0.5) {
			thisPlanet.moonAng += thisPlanet.moonSpd;
			if (thisPlanet.moonAng > Math.PI * 2) { planets[i].moonAng = 0; }
			thisPlanet.moonX = Math.cos(thisPlanet.moonAng) * thisPlanet.moonMag + thisPlanet.x;
			thisPlanet.moonY = Math.sin(thisPlanet.moonAng) * thisPlanet.moonMag + thisPlanet.y;
		}
	}
}

function draw_planets() {
	for (var i = 0; i<planets.length; i++) {
		// draw orbital path
		ctx.strokeStyle = "rgba(48, 48, 48, 0.6)";
		var thisPlanet = planets[i];
		var arcAngle = (thisPlanet.speed - 1) / 2;
		ctx.beginPath();
		ctx.arc(starX, starY, thisPlanet.magnitude, thisPlanet.angle, thisPlanet.angle + arcAngle, true);
		
		var arcEndX = Math.cos(thisPlanet.angle + arcAngle) * (thisPlanet.magnitude) + starX;
		var arcEndY = Math.sin(thisPlanet.angle + arcAngle) * (thisPlanet.magnitude) + starY;
		
		var gradient=ctx.createLinearGradient(thisPlanet.x,thisPlanet.y,arcEndX,arcEndY);
		gradient.addColorStop("0","white");
		gradient.addColorStop("1.0","rgba(0,0,0,0)");

		// Fill with gradient
		ctx.strokeStyle=gradient;
		ctx.stroke();
		ctx.closePath();

		// draw planet
		ctx.beginPath();
		ctx.arc(thisPlanet.x, thisPlanet.y, thisPlanet.radius, 0, Math.PI*2, false);

		// create radial gradient
		var gX = Math.cos(thisPlanet.angle) * (thisPlanet.magnitude - (thisPlanet.radius)) + starX;
		var gY = Math.sin(thisPlanet.angle) * (thisPlanet.magnitude - (thisPlanet.radius)) + starY;
		var grd = ctx.createRadialGradient(gX, gY, thisPlanet.radius / 4, gX, gY, thisPlanet.radius*2);
		grd.addColorStop(0, "#ddd");
		grd.addColorStop(0.7, thisPlanet.color);
		grd.addColorStop(1, "#000000");
		ctx.fillStyle = grd;
		ctx.fill();
		ctx.closePath();
		
		if (thisPlanet.hasMoon > 0.5) {
			// draw moon
			ctx.beginPath();
			ctx.arc(thisPlanet.moonX , thisPlanet.moonY, thisPlanet.moonRad, 0, Math.PI*2, false);
			var mGX = Math.cos(thisPlanet.moonAng) * (thisPlanet.moonMag - (thisPlanet.moonRad)) + thisPlanet.x;
			var mGY = Math.sin(thisPlanet.moonAng) * (thisPlanet.moonMag - (thisPlanet.moonRad)) + thisPlanet.y;
			var mGrd = ctx.createRadialGradient(mGX, mGY, thisPlanet.moonRad / 4, mGX, mGY, thisPlanet.moonRad*2);
			mGrd.addColorStop(0, "#ddd");
			mGrd.addColorStop(0.7, thisPlanet.moonColor);
			mGrd.addColorStop(1, "#000000");
			ctx.fillStyle = mGrd;
			ctx.fill();
			ctx.closePath();
			
			var mArcAngle = (thisPlanet.moonSpd - 1);
			var mArcEndX = Math.cos(thisPlanet.moonAng + mArcAngle) * (thisPlanet.moonMag) + thisPlanet.x;
			var mArcEndY = Math.sin(thisPlanet.moonAng + mArcAngle) * (thisPlanet.moonMag) + thisPlanet.y;
			
			ctx.beginPath();
			ctx.arc(thisPlanet.x, thisPlanet.y, thisPlanet.moonMag, thisPlanet.moonAng, thisPlanet.moonAng + mArcAngle, true);
			var gradient=ctx.createLinearGradient(thisPlanet.moonX,thisPlanet.moonY,mArcEndX,mArcEndY);
			gradient.addColorStop("0","white");
			gradient.addColorStop("1.0","rgba(0,0,0,0)");
			
			ctx.strokeStyle=gradient;
			ctx.stroke();
			ctx.closePath();
		}
		
	}
}

function deg2rad(deg) {
	return Math.PI / 180 * deg;
}

function rad2deg(rad) {
	return 180 / Math.PI * rad;
}

function resize() {
	var body = document.body;
    var html = document.documentElement;

	var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );
	var width = Math.min( body.scrollWidth, body.offsetWidth, 
                       html.clientWidth, html.scrollWidth, html.offsetWidth );				   
	canvas.width = width;
	canvas.height = height;
}



//Dynamic content
function onLoad() {
}

function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}


window.onload = onLoad;
init();
window.onresize = function(e) {
	resize();
};