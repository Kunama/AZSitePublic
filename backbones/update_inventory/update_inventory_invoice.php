<?php
$pageName="Update Inventory Invoice";
$roleNeeded=0;
ob_start();
session_start();
include('../includes/global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('../../login.php');
}
$po = $_POST['po'];
$item = $_POST['item'];
$query = $myPDO->prepare("SELECT `Number_of_Cartons` FROM `Inventory` WHERE `AZ_PO`=:po AND `Item_ID`=:item");
$query->bindParam(':po', $po, PDO::PARAM_STR, 12);
$query->bindParam(':item', $item, PDO::PARAM_STR, 12);
$query->execute();


                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  $cartons = $row["Number_of_Cartons"];
                }
echo json_encode($cartons);
