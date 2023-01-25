<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_POST['submit'])){
    if(isset($_SESSION['login'])){
        $stmt=$pdo->prepare('INSERT INTO auction (title, categoryid, description, enddate, userid, price)
        VALUES(:title, :categoryid, :description, :enddate, :userid, :price)        
        ');
        $value=[
            'title'=>$_POST['title'],
            'categoryid'=>$_POST['category'],
            'description'=>$_POST['description'],
            'enddate'=>$_POST['enddate'],
            'userid'=>$_SESSION['login'],
            'price'=>$_POST['price']
        ];
        $stmt->execute($value);
        echo '<p> auction added</p>';
    }else{
        echo 'log in to add auction';
    }
}else{
?>

<form action="addauction.php" method="post">
<label for="name">enter item name: </label>
<input type="text" name="title" id="name">
<label for="category">select item category: </label>
<select name="category" id="category" style="
    position: relative;
    bottom: 0.5em;
    right: 14em;
">
<?php
$category=$pdo->prepare('SELECT * FROM category');
$category->execute();
while($categories=$category->fetch()){
    echo '<option value="'.$categories['categoryid'].'">'.$categories['categoryid'].'</option>';
}
?>
</select>
<textarea name="description" id="description" cols="30" rows="10" placeholder="enter item description: "></textarea>
<label for="date">select end date: </label>
<input type="datetime-local" name="enddate" id="date">
<label for="price">enter the price: </label>
£<input type="number" name="price" id="price" step="0.01" placeholder="£123.00">
<input type="submit" value="add" name="submit">
</form>
<p><a href="userdashboard.php">go to dashboard</a></p>
<a href="index.php">go back home
<?php
}
require '../footer.php';
?>