<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ibuy Auctions</title>
		<link rel="stylesheet" href="ibuy.css" />
	</head>

	<body>
		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>
			<form action="#">
				<input type="text" name="search" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search" />
			</form>
<?php
if(isset($_SESSION['login'])){
	echo '<p>Hello '. $_SESSION['name'].'</p>';
	echo '<a href="logout.php">Log out</a>';
	echo '<a href="userdashboard.php" style="position: absolute; right: 8em; top: 7em;">user dashboard</a>';
	echo '<a href="admindashboard.php" style="position: absolute; right: 16em; top: 7em;">admin dashboard</a>';
}else{
echo '<a href="login.php" style="
position: relative;
left: 2em;
">Login</a>';
}



?>
		</header>

		<nav>
			<ul>
<?php
$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');
$stmt=$pdo->prepare('SELECT * FROM category');
$stmt->execute();

while($cat = $stmt->fetch()){
	echo '<li><a class="categoryLink" href="viewcategory.php?id='.$cat['categoryid'].'">'.$cat['categoryid'].'</a></li>';
}
?>
			</ul>
		</nav>
		<img src="banners/1.jpg" alt="Banner" />

		<main>
