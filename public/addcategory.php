<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_POST['submit'])){
    $stmt=$pdo->prepare('INSERT INTO category (categoryid)
    VALUES(:category)
    ');
    $value=[
        'category'=>$_POST['category']
    ];
    $stmt->execute($value);
    echo '<p>category added</p>';
    echo '<p><a href="addcategory.php">add category</a></p>';
    echo '<p><a href="admindashboard.php" style="
    margin-top: 1em;
    display: block;
">admin dashboard</a></p>';
}else{
?>
<form action="addcategory.php" method="post">
<label for="category">enter category name: </label>
<input type="text" name="category" id="category">
<input type="submit" value="add category" name="submit">
</form>
<p><a href="admindashboard.php">go to dashboard</a></p>
<a href="index.php">go back home</a>

<?php
}
require '../footer.php';
?>