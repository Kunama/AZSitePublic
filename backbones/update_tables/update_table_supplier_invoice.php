<?php
$pageName="Update Table Supplier Invoice";
$roleNeeded=0;
ob_start();
session_start();
include('../includes/global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('../../login.php');
}
$curinvoice = $_POST['invoice'];
$query = $myPDO->prepare("SELECT * FROM `Supplier_Invoice_Items` WHERE `Supplier Invoice ID`=:curinvoice");
$query->bindParam(':curinvoice', $curinvoice, PDO::PARAM_STR, 12);
$query->execute();
$superrow1 = [];
$superrow2 = [];
$superrow3 = [];


                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  array_push($superrow1, $row["ItemID"]);
                  array_push($superrow2, $row["No Of Cartons"]);
                  array_push($superrow3, $row["Price Per LB"]);
                }
echo json_encode(array($superrow1, $superrow2, $superrow3));
