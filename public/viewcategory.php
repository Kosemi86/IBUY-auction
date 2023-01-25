<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_GET['id'])){
    $stmt=$pdo->prepare('SELECT * FROM auction WHERE categoryid= :id');
    $value=[
        'id'=>$_GET['id']
    ];
    $stmt->execute($value);
}
echo '<a href="index.php"style="
margin-top: 1em;
display: block;
">go back home</a>';

echo '<ul class="productList">';
foreach($stmt as $row){
    echo '<li>';
    echo '<img src="product.png" alt="product name">';
    echo '<article>';
    echo '<h2> Product Name: ' .$row['title'].'</h2>';
    echo '<h3> Category: ' .$row['categoryid'].'</h3>';
    echo '<p> Description: ' .$row['description'].'</p>';
    echo '<p class="price">Current bid: £'.$row['price'].'</p>';
    echo '<a href="viewauction.php?id='.$row['id'].'" class="more auctionLink">More &gt;&gt;</a>';
    echo '</article>';
    echo '</li>';
}
echo '</ul>';

require '../footer.php';
?>