<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_POST['submit'])){
$stmt=$pdo->prepare('INSERT INTO user (email, password, name)
VALUES( :email, :password, :name)
');
$value=[
    'email'=>$_POST['email'],
    'password'=>$_POST['password'],
    'name'=>$_POST['name']
];
$stmt->execute($value);
echo '<p>You have registered!</p>';
echo '<a href="index.php">Go back home</a>';

$users=$pdo->prepare('SELECT * FROM user WHERE email = :email');
$value=[
    'email'=>$_POST['email']
];
$users->execute($value);

$user=$users->fetch();
$_SESSION['login']=$user['userid'];
$_SESSION['name']=$user['name'];
}else{
?>

<form action="register.php" method="post">
<label for="name">Firstname: </label>
<input type="text" name="name" id="name">
<label for="email">Enter email address: </label>
<input type="text" id="email" name="email">
<label for="password">Enter password: </label>
<input type="password" name="password" id="password">
<input type="submit" value="Register" name="submit">
</form>
<a href="login.php">Log in here</a>


<?php
}
require '../footer.php';
?>