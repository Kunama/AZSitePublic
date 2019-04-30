<?php
$pageName="New Item";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$itemSize = $_POST['itemSize'];
$package = $_POST['package'];
$species = $_POST['species'];
$brand = $_POST['brand'];
$itemID= $itemSize . ' ' . $species . ' ' . $package . ' ' . $brand;
$query = $myPDO->prepare("INSERT INTO `Items` (`Item_ID`, `ITEM_SIZE`, `PACKAGE`, `Species`, `Brand`) VALUES (:itemID, :itemSize, :package, :species, :brand)");
$query->bindParam(':itemID', $itemID, PDO::PARAM_STR, 12);
$query->bindParam(':itemSize', $itemSize, PDO::PARAM_STR, 12);
$query->bindParam(':package', $package, PDO::PARAM_STR, 12);
$query->bindParam(':species', $species, PDO::PARAM_STR, 12);
$query->bindParam(':brand', $brand, PDO::PARAM_STR, 12);
if ($query->execute()){
  redirect('items.php');
}
else{
  $_SESSION['error']="true";
  redirect('new_item.php');
}

?>
