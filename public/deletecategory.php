<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_POST['submit'])){
    $stmt=$pdo->prepare('DELETE FROM category WHERE categoryid= :category');

    $value=[
        'category'=>$_POST['category']
    ];
    $stmt->execute($value);
    echo '<p>category deleted</p>';
    echo '<p><a href="addcategory.php">add category</a></p>';
    echo '<p><a href="deletecategory.php">delete category</a></p>';
    echo '<p><a href="admindashboard.php" style="
    margin-top: 1em;
    display: block;
">admin dashboard</a></p>';
}else{
?>
<form action="deletecategory.php" method="post">
<label for="category">which category do you want to delete</label>
<select name="category" id="category">
<?php
$category=$pdo->prepare('SELECT * FROM category');
$category->execute();
while($stmt=$category->fetch()){
    echo '<option value="'.$stmt['categoryid'].'">'.$stmt['categoryid'].'</option>';
}
?>
</select>
<input type="submit" value="delete" name="submit" style="position: relative;top: 1em;">
</form>
<p><a href="admindashboard.php">go to dashboard</a></p>
<a href="index.php">go back home</a>

<?php
}
require '../footer.php'
?>