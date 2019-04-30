<?php
$pageName="Update Select New Invoice";
$roleNeeded=0;
ob_start();
session_start();
include('../includes/global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('../../login.php');
}
$item = $_POST['item'];
$query = $myPDO->prepare("SELECT `AZ PO` FROM `AZ_PO_Items` WHERE `ItemID`=:item");
$query->bindParam(':item', $item, PDO::PARAM_STR, 12);
$query->execute();
$superrow1 = [];

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  array_push($superrow1, $row["AZ PO"]);
                }
echo json_encode($superrow1);
