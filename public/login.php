<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');
$stmt=$pdo->prepare('SELECT * FROM user WHERE email = :email AND password = :password');

if(isset($_POST['submit'])){
    $values=[
        'email'=>$_POST['email'],
        'password'=>$_POST['password']
    ];
    $stmt->execute($values);
    if($stmt->rowCount()>0){
        $user=$stmt->fetch();
        $_SESSION['login']=$user['userid'];
        $_SESSION['name']=$user['name'];
        echo '<p>You have successfully logged in</p>';
        echo '<a href="userdashboard.php">go to user dashboard</a>';
    }else{
        echo '<p>Sorry, details invalid. Please try again.</p>';
        echo '<a href="login.php">Log in again</a>';
        echo '<a href="register.php">Or register an account</a>';
    }
}else{
?>
<form action="login.php" method="post">
    <label for="email">Enter your email address: </label>
    <input type="text" id="email" name="email">
    <label for="password">Enter your password: </label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Log in" name="submit">
</form>
<a href="register.php">Make an account here</a>


<?php
}
require '../footer.php';
?>