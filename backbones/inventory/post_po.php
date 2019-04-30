<?php
$pageName="Update Inventory PO";
$roleNeeded=0;
ob_start();
session_start();
include('../includes/global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('../../login.php');
}
$curpo = $_POST['po'];
$query = $myPDO->prepare("INSERT INTO `Inventory` (`AZ_PO`, `Item_ID`, `Number_of_Cartons`) SELECT `AZ PO`, `ItemID`, `No Of Cartons` FROM `AZ_PO_Items` WHERE `AZ PO` = :curpo");
$query->bindParam(':curpo', $curpo, PDO::PARAM_STR, 12);
$query->execute();
//echo $query;
// $superrow1 = [];
// $superrow2 = [];
// $superrow3 = [];
// $superrow4 = [];
//
//                 while($row = $query->fetch(PDO::FETCH_ASSOC)){
//                   array_push($superrow1, $row["AZ PO"]);
//                   array_push($superrow2, $row["ItemID"]);
//                   array_push($superrow3, $row["No of Cartons"]);
//                   array_push($superrow4, $row["Price Per LB"]);
//                 }
// echo json_encode(array($superrow1, $superrow2, $superrow3, $superrow4));
