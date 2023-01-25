<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_POST['submit'])){
    $category=$pdo->prepare('SELECT * FROM category');
    $category->execute();
    $category->fetch();

    $stmt=$pdo->prepare('UPDATE category SET
    categoryid=:newcategory
    WHERE categoryid=:oldcategory
    ');
    $value=[
        'newcategory'=>$_POST['newcategory'],
        'oldcategory'=>$_POST['oldcategory']
    ];
    $stmt->execute($value);

    echo 'category updated';
    echo '<p><a href="addcategory.php">add category</a></p>';
    echo '<p><a href="editcategory.php">edit category</a></p>';
    echo '<p><a href="deletecategory.php">delete category</a></p>';
    echo '<p><a href="admindashboard.php" style="
    margin-top: 1em;
    display: block;
">admin dashboard</a></p>';
}else{
?>
<form action="editcategory.php" method="post">
<label for="category">what category do you want to edit</label>
<select name="oldcategory" id="category" style=" margin: 1em; display: inline; position: relative; right: 13em">
<?php
$category=$pdo->prepare('SELECT * FROM category');
$category->execute();
while($stmt=$category->fetch()){
    echo '<option value="'.$stmt['categoryid'].'">'.$stmt['categoryid'].'</option>';
}
?>
</select>
<label for="newcategory">enter new category: </label>
<input type="text" name="newcategory" id="newcategory">
<input type="submit" value="edit" name="submit" style="position: relative;top: 1em;">
</form>
<p><a href="admindashboard.php">go to dashboard</a></p>
<a href="index.php">go back home</a>

<?php
}
require '../footer.php';
?>