<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_SESSION['login'])){
    $stmt=$pdo->prepare('SELECT * FROM auction WHERE userid = :id');
    $value=[
        'id'=>$_SESSION['login']
    ];
    $stmt->execute($value);
}

echo 'select auction to edit';
echo '<ul>';
while($auction=$stmt->fetch()){
    echo '<li><a href="editauction.php?id=' .$auction['id'].'">'.$auction['title'].'</a></li>';
}
echo '</ul>';





require '../footer.php';
?>