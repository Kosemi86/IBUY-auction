<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_GET['id'])){
    $stmt = $pdo->prepare('SELECT * FROM auction WHERE id = :id');
    $value=[
        'id'=>$_GET['id']
    ];
    $stmt->execute($value);
}

if(isset($_POST['submit'])){
    $stmt=$pdo->prepare('SELECT * FROM auction WHERE id = :id');
    $value=[
        'id'=>$_GET['id']
    ];
    $stmt->execute($value);
    $listing=$stmt->fetch();

    $price=$pdo->prepare('UPDATE auction SET 
    price=:newprice
    WHERE price = :oldprice
    ');
    $values=[
        'newprice'=>$_POST['newprice'],
        'oldprice'=>$_POST['price']
    ];
    $price->execute($values);
    echo 'placed';
}else{
    while($listing=$stmt->fetch()){
        $user=$pdo->prepare('SELECT * FROM user WHERE userid=:id');
        $value=[
            'id'=>$listing['userid']
        ];
        $user->execute($value);
        $bidder=$user->fetch();
echo '<h1>Product Page For '.$listing['title'].'</h1>';
echo '<article class="product">';
echo '<img src="product.png" alt="product name">';
echo '<section class="details">';
echo '<h2>Product name: '.$listing['title'].'</h2>';
echo '<h3>Product category: '.$listing['categoryid'].'</h3>';
echo '<p>Auction created by ' .$bidder['name'].'</p>';
echo '<p class="price">Current bid: £' .$listing['price'].'</p>';
echo '<p>item ends on '.$listing['enddate'].'</p>';
?>

<form action="viewauction.php" method="post">
<input type="hidden" name="price" value="<?php echo $listing['price'];?>">
<label for="price">how much do you want to pay</label>
£<input type="number" name="newprice" id="price">
<input type="submit" value="pay" name="submit">
</form>




<?php
echo '</section>';
echo '<section class="description">';
echo '<p>' .$listing['description'].'</p>';
echo '</section>';
    }
}
echo '<section class="reviews">';
echo '<h2>Reviews of ' .$bidder['name'] . '</h2>';

$reviews=$pdo->prepare('SELECT * FROM review');
$user=$pdo->prepare('SELECT * FROM user WHERE userid=:id');
$reviews->execute();
echo '<ul>';

foreach($reviews as $review){
    $value=[
        'id'=>$review['userid']
    ];
    $user->execute($value);
    $name=$user->fetch();

    echo '<li><strong>';
    echo $name['name']. ' said </strong>'.$reviews['review'];
    echo '</li>';
}
echo '</ul>';

if(isset($_SESSION['login'])){
    if(isset($_POST['submit'])){
        $stmt=$pdo->prepare('INSERT INTO review (review, reviewer, reviewee)
        VALUES(:review, :reviewer, :reviewee)
        ');
    $values=[
        'review'=>$_POST['review'],
        'reviewer'=>$_SESSION['name'],
        'reviewee'=>$user['name']
    ];
    $stmt->execute($values);
    echo 'review posted';

    }else{
?>

<form action="viewauction.php" method="post">
<label for="review">write your review</label>
<input type="text" name="review" id="review">
<input type="submit" value="review" name="submit">
</form>
<?php
    }
}else{
    echo 'log in to review';
}
echo '</section>';
echo '</article>';
require '../footer.php';
?>