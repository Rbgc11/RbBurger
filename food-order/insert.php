<?php include('config/constants.php'); ?>


<?php
$quantity=$_POST['quantity'];
$id_food=$_POST['id_food'];
$id_order=$_POST['id_order'];
$sql="INSERT INTO `tbl_cart` (`id`, `quantity`, `id_food`, `id_order`) VALUES (NULL, '$quantity', '$id_food', '$id_order')";
if ($conn->query($sql) === TRUE) {
    echo "data inserted";
}
else 
{
    echo "failed";
}
?>