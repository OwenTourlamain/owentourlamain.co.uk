<?php
	session_save_path("./sessions");
	session_start();
	if (isset($_POST['username'])) {
		$_SESSION['username'] = $_POST['username'];
	} else {
		session_start();
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="./style/index.css" />
		<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
		<title>Notes</title>
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
				if(isset($_SESSION['username'])) {	
					
					echo "<h1>Welcome, <a class='bold'>" . $_SESSION['username'] . "</a></h1>\n
						<p>Please rememember, this is not a real shop! Please don't try to buy anything.</p>";
					
					$db = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=teaching user=csguest password=r3p41r3d");
					if (!db) {
						die('Database Error, please contact server admin!'); //. pg_error());
					}
					
					echo "<table>\n<tbody>\n<tr>";
					if (isset($_GET['search'])) {
						switch ($_GET['search']) {
							case "all":
								$query = pg_query($db, "SELECT * FROM music WHERE 
								artist LIKE '%" . $_GET['term'] . "%' OR 
								composer LIKE '%" . $_GET['term'] . "%' OR 
								title LIKE '%" . $_GET['term'] . "%' OR
								album LIKE '%" . $_GET['term'] . "%'");
								echo "<h1>Browsing: <a class='bold'>" . $_GET['term'] . "</a></h1>\n";
								break;
							case "adv":
								$query = pg_query($db, "SELECT * FROM music WHERE 
								artist LIKE '%" . $_GET['artist'] . "%' OR 
								composer LIKE '%" . $_GET['writer'] . "%' OR 
								title LIKE '%" . $_GET['track'] . "%' OR
								album LIKE '%" . $_GET['album'] . "%' OR
								title LIKE '%" . $_GET['track'] . "%' AND 
								genre = '" . $_GET['genre'] . "' AND
								price BETWEEN " . $_GET['min'] . " AND " . $_GET['max'] . ";");
								echo "<h1>Browsing: <a class='bold'>All Songs</a></h1>\n";
								break;
							default:
								$query = pg_query($db, "SELECT * from music ORDER BY ref");
								echo "<h1>Browsing: <a class='bold'>All Songs</a></h1>\n";
								break;
						}
						
						echo "<div id='filter'>\n
						<h1 class='bold' onclick='toggleAdvSearch()' id='asButton'>Advanced Search</h1>\n
						<form name='filters' method='GET'>\n
						<input name='search' value='adv' type='hidden'></input>\n
						<input class='hide'name='artist' placeholder='Artist'></input>\n
						<input class='hide' name='album' placeholder='Album'></input>\n
						<input class='hide' name='track' placeholder='Track'></input>\n
						<input class='hide' name='writer' placeholder='Writer'></input>\n
						<select class='hide' name='genre'></input>\n
						<option value='' selected>-Select-</option>\n";
						$genres = pg_query($db, "SELECT DISTINCT genre FROM music;");
						while ($g = pg_fetch_array ($genres))
						{
							echo "<option value='" . htmlspecialchars($g[0], ENT_QUOTES) . "'>" . htmlspecialchars($g[0], ENT_QUOTES) . "</option>\n";
						}
						echo "</select>\n
						<p class='hide'>Prices between:</p><input class='hide' name='min' value='0' type='number'></input>\n
						<p class='hide'>and:</p><input class='hide' name='max' value='99999' type='number'></input>\n
						<button class='hide' type='submit'>Go</button>\n
						</form>\n
						</div>\n";
							
//artist VARCHAR (100),
//composer VARCHAR (50),
//genre VARCHAR (10),
//title VARCHAR (100),
//album VARCHAR (100),
//price DECIMAL (5,2),
					} else {
						$query = pg_query($db, "SELECT * from music ORDER BY ref");
						echo "<h1>Browsing: <a class='bold'>All Songs</a></h1>\n";
					}
					$i = 1;
					while ($row = pg_fetch_array ($query))
					{
						
						// htmlspecialchars converts things like & to HTML entity codes
						$artist = str_replace(" ", "+", $row[1]);
						$itunes_url = "http://ax.phobos.apple.com.edgesuite.net/WebObjects/MZStoreServices.woa/wa/wsSearch?term=" . $artist . "&limit=1";
						$response = file_get_contents($itunes_url);
						$obj = utf8_decode($response);
						$results = json_decode($obj);
						$img = $results->results[0]->artworkUrl100;
						$img = str_replace("100x100-75", "600x600-75", $img);
						if ($img == "") { $img = "./images/defaultAlbumArt.png"; }
						echo "<td>\n<div class='dummy'></div>\n";
						echo "<div class='image' style='background-image: url(" . $img .");'>\n<div class='info'>\n";
						echo "<p class='title'>" . htmlspecialchars(truncate($row[4]), ENT_QUOTES) . "</p>\n"
							. "<div class='imgfoot'>\n"
							. "<p class='artist'>" . htmlspecialchars(truncate($row[1]), ENT_QUOTES) . "</p>\n" 
							. "<p class='album'>" . htmlspecialchars(truncate($row[5]), ENT_QUOTES) . "</p>\n" 
							. "<p class='price'>" . $curr . htmlspecialchars(truncate($row[7]), ENT_QUOTES) . "</p>\n"
							. "<img class='addBasket' onclick='addToBasket(this, " . htmlspecialchars($row[0], ENT_QUOTES) . ")' src='./images/cartIcon.png'></img>\n"
							. "</div>\n</div>\n</div>\n</td>\n";
						
						if ($i % 5 == 0) { echo "</tr>\n<tr>"; }
						$i++;
					}
					echo "</tr>\n</tbody>\n</table>";
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
			<?php
			/*
				$con=pg_connect("host=db.dcs.aber.ac.uk port=5432
				dbname=teaching user=csguest password=r3p41r3d");
				if (!con)
				{
					die('Database Error, please contact server admin!'); //. pg_error());
				}
				
				$res = pg_query ($con, "select count(ref) from music");
				$a=pg_fetch_row($res);
				echo "<p>Total " . $a[0] . " music in database.</p>";

				echo "<table border='1'>\n<thead>\n<tr>\n";
				echo "<th>Ref</th><th>Artist</th><th>Composer</th><th>Genre</th><th>Title</th><th>Album</th><th>Label</th><th>Price</th><th>Description</th><th>Entered by</th>\n";
				echo "</tr>\n</thead>\n<tbody>\n";
				$res=pg_query($con, "SELECT * from music ORDER BY ref");
				while ($a = pg_fetch_array ($res))
				{
					echo "<tr>";
					for ($j = 0; $j < pg_num_fields($res); $j++) {
						// htmlspecialchars converts things like & to HTML entity codes
						echo "<td>" . htmlspecialchars($a[$j], ENT_QUOTES) . "</td>";
					}
					echo "</tr>\n";
				}
				echo "</tbody>\n</table>";
			*/		
			?>
		</main>
		<form name="basketfrm" action="./checkout.php" method="POST">
		<input type="hidden" name="tempBasket" id="postBasket" value=""></input>
		</form>
	</body>
</html>
