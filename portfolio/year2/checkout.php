<?php
	session_save_path("./sessions");
	session_start();
	if(!isset($_POST['tempBasket'])) {
		header("Location: index.php");
		die();
	}
	$Basket = explode(",", $_POST['tempBasket']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Notes</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="./style/index.css" />
		<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<script src="./script/index.js"></script>
		<header>
			<?php
				require "./phpextras/header.php";	
			?>
		</header>
		<div id="filler"></div>
		<main>
			<?php
				$curr = "£";
				echo "<h1><a class='bold'>" . $_SESSION['username'] . "</a>'s basket</h1>\n
						<p>Please rememember, this is not a real shop! Please don't try to buy anything.</p>";
					
				$db = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=teaching user=csguest password=r3p41r3d");
				if (!db) {
					die('Database Error, please contact server admin!'); //. pg_error());
				}
				
				echo "<table>\n<tbody>\n<tr>";
					
				for ($i = 0; $i < count($Basket); $i++) {
					$item = pg_query($db, "SELECT * FROM music WHERE ref=" . $Basket[$i] . ";");
					echo "Result: " . $item[1];
					$artist = str_replace(" ", "+", $item[1]);
					$itunes_url = "http://ax.phobos.apple.com.edgesuite.net/WebObjects/MZStoreServices.woa/wa/wsSearch?term=" . $artist . "&limit=1";
					$response = file_get_contents($itunes_url);
					$obj = utf8_decode($response);
					$results = json_decode($obj);
					$img = $results->results[0]->artworkUrl100;
					$img = str_replace("100x100-75", "600x600-75", $img);
					if ($img == "") { $img = "./images/defaultAlbumArt.png";
					
					echo "<td>\n<div class='dummy'></div>\n";
					echo "<div class='image' style='background-image: url(" . $img .");'>\n<div class='info'>\n";
					echo "<p class='title'>" . htmlspecialchars(truncate($item[4]), ENT_QUOTES) . "</p>\n"
						. "<div class='imgfoot'>\n"
						. "<p class='artist'>" . htmlspecialchars(truncate($item[1]), ENT_QUOTES) . "</p>\n" 
						. "<p class='album'>" . htmlspecialchars(truncate($item[5]), ENT_QUOTES) . "</p>\n" 
						. "<p class='price'>" . $curr . htmlspecialchars(truncate($item[7]), ENT_QUOTES) . "</p>\n"
						. "<img class='addBasket' onclick='addToBasket(this, " . htmlspecialchars($item[0], ENT_QUOTES) . ")' src='./images/cartIcon.png'></img>\n"
						. "</div>\n</div>\n</div>\n</td>\n";
					}
				}
				function truncate($str) {
						if (strlen($str) <= 18) {
							return $str;
						} else {
							$str = substr($str, 0, 15);
							$str = $str . "...";
							return $str;
						}
				}
			?>
		</main>
	</body>
</html>
