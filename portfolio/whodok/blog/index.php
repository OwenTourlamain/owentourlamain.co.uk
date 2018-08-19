<!DOCTYPE html>

<!--
	copyright ©, Owen Tourlamain - Whodok Games, 2014
	Version: 1.0
	Date Modified: 01/06/2014
-->

<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="../style/whodok.css" />
		<meta charset="UTF-8" />
		<title>Whodok | innovation and creativity: by people, for people.</title>
	</head>
	<body>
		<canvas id="canvas"></canvas>
		<div id="foreground">
			<main>
				<div id="img_wrapper">
					<a href="../index.html"><img src="../images/cropped-whodok_final.png" alt="Whodok" id="logo_img" /></a>
				</div>
				<br/>
				<div id="wrapper_div">
					<div id="left_fade"></div>
					<nav>
						<ul class="menu_main">
							<li><a class="nav_a" href="../index.php">Back to Site</a>
							<li><a class="nav_a" href="index.php">Blog Home</a>
							</li>
							<li><a class="nav_a">Latest Posts</a>
								<ul>
									<?php
										$postList = listdir_by_date('posts/');
										$dom = new DOMDocument();
										$a = 0;
										foreach ($postList as $post => $i) {
											$dom->loadHTMLFile('posts/' . $i);
											$titleElement = $dom->getElementById('title');
											$title = get_inner_html($titleElement);
											$a++;
											echo '<li><hr class="list_hr"/></li>';
											if ($a == 5 or $a == count($postList)) {
												echo '<li><a class="nav_a_drop last" href="post.php?post=' . $i . '">' . $title . '</a></li>';
											} else {
												echo '<li><a class="nav_a_drop" href="post.php?post=' . $i . '">' . $title . '</a></li>';
											}
											if ($a == 5) {
												break;
											}
											
										}						
									?>
								</ul>
							</li>
						</ul>
					</nav>
					<div id="right_fade"></div>
				</div>
				<div id="slide_container">
					<div id="holder_div" class="open">
						<?php
							$postList = listdir_by_date('posts/');
							$dom = new DOMDocument();
							$a = 0;
							foreach ($postList as $post => $i) {
								$dom->loadHTMLFile('posts/' . $i);
								$a++;
								$titleElement = $dom->getElementById('title');
								$title = get_inner_html($titleElement);
								echo '<h1><a href="post.php?post=' . $i . '">' . $title .'</a></h1>';
								$previewElement = $dom->getElementById('previewImg');
								if ($previewElement != null) {
									$previewSrc = $previewElement->getAttribute('src');
									echo '<img src="' . $previewSrc . '" />';
								}
								$blurbElement = $dom->getElementById('blurb');
								$blurb = get_inner_html($blurbElement);
								echo '<p>' . "$blurb" . '</p>';
								echo '<br/>';
								if ($a != count($postList)) {
									echo '<hr/>';
								}
							}
							
							echo '<br/>';
							
							function listdir_by_date($path){
								//code taken from http://www.jonasjohn.de/snippets/php/listdir-by-date.htm
								//code is in the public domain
								$dir = opendir($path);
								$list = array();
								while($file = readdir($dir)){
								        if ($file != '.' and $file != '..' and $file != 'default.html'){
						          	        // add the filename, to be sure not to
						                        // overwrite a array key
							                 $ctime = filectime($path . $file) . ',' . $file;
								        	$list[$ctime] = $file;
							        	}
								}
								closedir($dir);
								krsort($list);
								return $list;
							}
							
							function get_inner_html( $node ) { 
								$innerHTML= ''; 
								$children = $node->childNodes; 
								foreach ($children as $child) { 
									$innerHTML .= $child->ownerDocument->saveXML( $child ); 
								} 
								return $innerHTML; 
							}							
						?>
					</div>
				</div>				
			</main>	
		</div>
		<script src="../script/starsnodynamic.js"></script>
	</body>
</html>
