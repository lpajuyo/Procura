<?php 

include 'connection.php';

$image = $_FILES['image']['name'];

$imagePath = "C://xampp/htdocs/Procura/storage/app/public/user_images/".$image;

$ID = $_POST['idnum'];

move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

$newpath = 'user_images/'.$image;

$connect->query("UPDATE users SET user_image = '".$newpath."' WHERE id = '".$ID."'");

?>