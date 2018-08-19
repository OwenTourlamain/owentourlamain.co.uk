<!--
	copyright ©, Owen Tourlamain - Whodok Games, 2014
	Version: 1.0
	Date Modified: 01/06/2014
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="./style/whodok.css" />
		<link rel="stylesheet" type="text/css" href="../portfolioHeader.css" />
		<meta charset="UTF-8" />
		<title>Whodok Games | innovative games: by people, for people.</title>
	</head>
	<body>
		<?php
			echo '
			<div id="pHead">
				<a id="pBack" href="../../">
					Back
				</a>
				<p>
					These pages showcase my work for Whodok. 
					These pages are presented as examples of my 
					work. They are in no way associated with, or 
					representative of, Whodok in any way.
				</p>
			</div>';
		?>
		<canvas id="canvas"></canvas>
		<div id="foreground">
			<main>
				<div id="img_wrapper">
					<img src="images/cropped-whodok_final.png" alt="Whodok" onclick="show_home();" id="logo_img" />
				</div>
				<br/>
				<div id="wrapper_div">
					<div id="left_fade"></div>
					<nav>
						<ul class="menu_main">
							<li><a class="nav_a">Who We Are</a>
								<ul>
									<li><hr class="list_hr"/></li>
									<li><a onclick="show_home();" class="nav_a_drop">Home</a>
									<hr class="list_hr"/></li>
									<li><a onclick="show_team();" class="nav_a_drop">Team</a>
									<hr class="list_hr"/></li>
									<li><a href="./blog/index.php" class="nav_a_drop last">Blog</a></li>
								</ul>
							</li>
							<li><a class="nav_a">What We Do</a>
								<ul>
									<li><hr class="list_hr"/></li>
									<li><a onclick="show_games();" class="nav_a_drop">Games</a>
									<hr class="list_hr"/></li>
									<li><a onclick="show_films();" class="nav_a_drop last">Films</a></li>
								</ul>
							</li>
							<li><a class="nav_a">Get In Touch</a>
								<ul>
									<li><hr class="list_hr"/></li>
									<li><a onclick="show_contact();" class="nav_a_drop">Contact</a>
									<hr class="list_hr"/></li>
									<li><a class="nav_a_drop last">Jobs</a></li>
								</ul>
							</li>
						</ul>
					</nav>
					<div id="right_fade"></div>
				</div>
				<div id="slide_container">
					<div id="holder_div" class="close"></div>
				</div>
				
				<div class="hidden" id="home_div">
					<h1>Welcome to Whodok.com</h1>
					<p><strong>Who we are</strong></p>
					<p>Whodok is an indie platform that nurtures
					innovation and creativity. Our network spans
					three countries and, with other 20 staff members
					dedicated to creating exciting products, we are
					confident in our ability to change the face of
					entertainment. We currently specialise in 
					movies and games.</p>
				</div>
				
				<div class="hidden" id="team_div">
					<h1>Our Team</h1>
					
					<h2><strong>Board of Directors</strong></h2>
					<p><strong>Chief Executive Officer:</strong> Michael Mander</p>
					<p><strong>Vice-Director:</strong> Daniel Birch</p>
					<p><strong>Director of Mechanics:</strong> Christopher Gough</p>
					<p><strong>Director of Graphics:</strong> Andrew Twigg</p>
					<br/>
					
					<p><strong>Web Team:</strong></p>
					<p>Owen Tourlamain.</p>
					<br/>
					
					<h2><strong>Through the Void</strong></h2>

					<p><strong>Head Writers:</strong></p>
					<p>Renae Archer and Ryan Ashwood</p> 
					<p><strong>Written by:</strong></p> 
					<p>Christopher Gough, Corey James, Jonathon Maskill</p> 
					<br/>

					<p><strong>Mechanics and Graphics by:</strong></p>  
					<p>Christopher Gough, Corey James, Daniel Bliss, Andrew Twigg, Dan Walters</p> 
					<br/>

					<p><strong>Sound by:</strong></p>  
					<p>Daniel Birch, Dan Stayt</p> 
					<br/>
										
					<h2><strong>Mr Independent Games</strong></h2>
					<p>Josh Kierzek – Founder/Designer</p>
					<p>Ty Pagel – Designer/QA Analyst</p>
					<p>Katie Camacho – Artist</p>
					<p>Caleb Stamper – Programmer</p>
				</div>
				
				<div class="hidden" id="games_div">
					<h1>Current Projects</h1> 
					<h2>Through the Void</h2>					
					<h3>Whodok's first major release is Through the Void - a time travel game like no other.</h3> 
					
					<h3><strong>Update!</strong> minigame first build now availiable <a href="builds/projectInfinity/build.html">here</a></h3>
					
					<p>Players are immersed into a compelling story 
					with puzzles and action game play. Through the 
					Void is currently in pre-production and more 
					information will be revealed soon.</p> 
					<br/>
					<p><em>As a young child you always dreamed of
					adventure; you did not care much for where it 
					would take you, nor the danger involved in such
					an adventure, dreaming of distant planets and 
					far away times that were in your grasp yet not
					even there. Some people frowned upon such 
					behaviour; only a few close friends around you
					felt the same.</em></p>
					
					<p><em>As you grew older, the adventure you dreamed of
					became less and less likely. Mankind had already
					found everything there was to find, until one man
					decided that this was not enough, that mankind
					had progressed too slowly and was slowly becoming
					a less dominant race among the stars. This man
					proposed an idea: travel through time and control
					it to our benefit. Impossible, everyone believed,
					until later when this man disappeared and something
					changed. </em></p>
					
					<p><em>The people around did not notice it, the scientists
					did not notice; everything carried on the same but
					for you. Something was different. The same man 
					returned but no one knew him and no one cared that
					things were changing: the way the city looked, the
					giant building that loomed over head now, belonging
					to a company known as Omega. </em></p>
					
					<p><em>It became an adventure for you to find out what this was.</em></p>
					<hr/>
					<h2>Project Puzzle Force - Mr Independent Games</h2>
					<p>Project Puzzle Force (working title) is a mash-up 
					of an arcade shoot 'em up in the vein of Space Invaders 
					and a puzzle game like Puyo Pop Fever to create a unique, 
					action-oriented puzzle experience. Dodge enemies, clear 
					lines, collect power ups, battle bosses, and compete for 
					the highest score!</p>
				</div>
				
				<div class="hidden" id="films_div">
					<h1>Whodok Films</h1>
					<h2>H&W Films - a member of the Whodok Network - are currently 
					in post-production of their short film: <em>Thicker than Water</em></h2>
					<p>Thicker than Water is a tragic and powerful story of brotherhood 
					and retribution. Clayton, Jesse and George try to hold on to their 
					homestead while James O'Connell comes to steal, kill and destroy.</p>
					<div class="you-tube">
						<iframe width="100%" height="100%" src="//www.youtube.com/embed/PEtcvD71AAQ?rel=0" frameborder="0" allowfullscreen></iframe>
					</div>
					<p>View on IMBD: <a href="http://www.imdb.com/title/tt3739210/">Thicker Than Water</a></p>
					
				
				</div>
				
				<div class="hidden" id="contact_div">
					<h1>Email:</h1>
					<p>director@whodok.com</p>
				</div>
				
			</main>	
		</div>
		<script src="script/stars.js"></script>
	</body>
</html>
