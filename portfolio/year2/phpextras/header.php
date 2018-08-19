<nav id="menu">
	<div class="navButtonLeft topButton">
		<div class="navImgLeft">
			<img src="./images/searchIcon.png" onclick="document.forms['searchfrm'].submit();" class="icon"></img>
		</div>
		<div class="navTextLeft">
			<form name='searchfrm' action='index.php' method='GET'>
			<input name='search' value='all' type='hidden'></input>
			<input name='term' id="search"></input>
			</form>
		</div>
	</div>
	<a href="index.php">
		<div class="navButtonLeft" >
			<div class="navImgLeft">
				<img src="./images/browseIcon.png" class="icon"></img>
			</div>
			<div class="navTextLeft">
				<h1>Home</h1>
			</div>
		</div>
	</a>
	<div class="navButtonLeft" onclick="checkout();">
		<div class="navImgLeft">
			<img src="./images/checkoutIcon.png" class="icon"></img>
		</div>
		<div class="navTextLeft">
			<h1>Checkout</h1>
		</div>
	</div>
	<a href="about.html">
		<div class="navButtonLeft">
			<div class="navImgLeft">
				<img src="./images/aboutIcon.png" class="icon"></img>
			</div>
			<div class="navTextLeft">
				<h1>About</h1>
			</div>
		</div>
	</a>
	<div id="navEndLeft" onclick="toggleNav()">
		<div class="navImgLeft">
			<img src="./images/menuIcon.png" class="icon"></img>
		</div>
		<div class="navTextLeft">
			<h1 id="menuText">Menu</h1>
		</div>
	</div>
</nav>
<div id="logoDiv">
	<h1 id="logoH1">Notes</h1>
	<img src="./images/noteLogo.png" class="icon"></img>
</div>
<div id="settings">
	<div class="navButtonRight" onclick="document.forms['logoutfrm'].submit();">
		<div class="navTextRight">
			<?php
				if (isset($_SESSION['username'])) { 
					echo "<h1>Logout</h1>\n
					<form name='logoutfrm' action='index.php' method='GET'>\n
					<input name='logout' value='1' type='hidden'></input>\n
					</form>\n 
					"; 
				} else { 
					echo "<div id='login'>\n 
					<div>\n
					<h1>Please log in to access Notes</h1>\n 
					<form action='index.php' method='POST' onsubmit='return loginVal();'>\n
					<input id='loginBox' placeholder='Username' maxlength='20' name='username'></input>\n 
					<button id='loginButton' type='submit'>Login</button>\n 
					</form>
					</div>\n</div>\n"; 
				}
			?>
		</div>
		<div class="navImgRight">
			<img src='./images/logoutIcon.png' class='icon'></img>
		</div>
	</div>
	<?php
		if (isset($_SESSION['username'])) { echo "<div id='navEndRight' onclick='toggleSettings()'>"; }
		else { echo "<div id='navEndRight'>"; }
	?>
		<div class="navTextRight">
			<h1 id="settingsText">Settings</h1>
		</div>
		<div class="navImgRight">
			<img src="./images/settingsIcon.png" class="icon"></img>
		</div>
	</div>
</div>
