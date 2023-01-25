<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

$stmt = $pdo->prepare('SELECT * FROM auction ORDER BY endDate LIMIT 10');

$stmt->execute();
?>

<h1>Latest Listings / Search Results / Category listing</h1>
<?php
echo '<ul class="productList">';
foreach($stmt as $listing){
    echo '<li>';
    echo '<img src="product.png" alt="product name">';
    echo '<article>';
    echo '<h2>Product Name: ' . $listing['title'] . '</h2>';
    echo '<h3>Product Category: '. $listing['categoryid'].'</h3>';
    echo '<p>Description: '. $listing['description'].'</p>';
    echo '<h1>Ends on: '.$listing['enddate'].'</h1>';
    echo '<p class="price">Current bid: £'.$listing['price'].'</p>';
    echo '<a href="viewAuction.php?id="'.$listing['id'].'" class="more auctionLink">More &gt;&gt;</a>';
    echo '</article>';
    echo '</li>';
}
echo '</ul>';
require '../footer.php';
?>