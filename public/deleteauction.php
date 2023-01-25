<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_POST['submit'])){
    $stmt=$pdo->prepare('DELETE FROM auction WHERE id= :id');
    $value=[
        'id'=>$_POST['title']
    ];
    $stmt->execute($value);
    echo '<p>auction deleted</p>';
    echo '<p><a href="deleteauction.php">delete auction</a></p>';
    echo '<p><a href="addauction.php">add auction</a></p>';
    echo '<p><a href="editauction.php">edit auction</a></p>';
}else{
?>
<form action="deleteauction.php" method="post">
<label for="title">select auction to delete</label>
<select name="title" id="title">
<?php
$auction=$pdo->prepare('SELECT * FROM auction WHERE userid = :userid');
$value=[
    'userid'=>$_SESSION['login']
];
$auction->execute($value);
while($listing=$auction->fetch()){
    echo '<option value="'.$listing['id'].'">'.$listing['title'].'</option>';
}
?>
</select>
<input type="submit" value="delete" name="submit">
</form>
<p><a href="userdashboard.php">go bacj to dashboard</a></p>
<?php
}
require '../footer.php';
?>