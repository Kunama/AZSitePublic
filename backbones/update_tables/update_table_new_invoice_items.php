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
$po = $_POST['po'];
$query = $myPDO->prepare("SELECT ItemID FROM `AZ_PO_Items` WHERE `AZ PO`=:po");
$query->bindParam(':po', $po, PDO::PARAM_STR, 12);
$query->execute();
$superrow1 = [];

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  array_push($superrow1, $row["ItemID"]);
                }
echo json_encode($superrow1);
