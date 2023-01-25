<?php
require '../header.php';

$pdo = new PDO('mysql:host=mysql;dbname=as1', 'v.je', 'v.je');

if(isset($_GET['id'])){
    if(isset($_POST['submit'])){
        $stmt=$pdo->prepare('SELECT * FROM auction WHERE id = :id');
        $value=[
            'id'=>$_GET['id']
        ];
        $stmt->execute($value);
        $auction=$stmt->fetch();

        $update=$pdo->prepare('UPDATE auction 
        SET title=:newtitle,
        description=:newdescription,
        categoryid=:newcategoryid,
        enddate=:newdate,
        price=:newprice
        WHERE id=:id
        ');
$values =[
    'newtitle'=>$_POST['title'],
    'newdescription'=>$_POST['description'],
    'newcategoryid'=>$_POST['category'],
    'newdate'=>$_POST['enddate'],
    'newprice'=>$_POST['price'],
    'id'=>$_GET['id']
];
$update->execute($values);

echo 'auction altered';
    }else{
        $find=$pdo->prepare('SELECT * FROM auction WHERE id = :id');
        $value=[
            'id'=>$_GET['id']
        ];
        $find->execute($value);
        $listing=$find->fetch();
?>
<form action="addauction.php" method="post">
<label for="name">enter item name: </label>
<input type="text" name="title" id="name" value="<?php echo $listing['title'];?>">
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
<textarea name="description" id="description" cols="30" rows="10" placeholder="enter item description: "><?php echo $listing['description'];?></textarea>
<label for="date">select end date: </label>
<input type="datetime-local" name="enddate" id="date" value="<?php echo $listing['enddate'];?>">
<label for="price">enter the price: </label>
£<input type="number" name="price" id="price" step="0.01" placeholder="£123.00" value="<?php echo $listing['price'];?>">
<input type="submit" value="edit" name="submit">
</form>

<?php
    }
}

require '../footer.php';
?>