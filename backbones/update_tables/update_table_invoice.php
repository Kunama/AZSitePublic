<?php
$pageName="Update Table Invoice";
$roleNeeded=0;
ob_start();
session_start();
include('../includes/global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('../../login.php');
}
$curinvoice = $_POST['invoice'];
$query = $myPDO->prepare("SELECT * FROM `Invoice_Items` WHERE `AZ INVOICE`=:curinvoice");
$query->bindParam(':curinvoice', $curinvoice, PDO::PARAM_STR, 12);
$query->execute();
$superrow1 = [];
$superrow2 = [];
$superrow3 = [];
$superrow4 = [];

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  array_push($superrow1, $row["AZ PO"]);
                  array_push($superrow2, $row["ItemID"]);
                  array_push($superrow3, $row["No of Cartons"]);
                  array_push($superrow4, $row["Price Per LB"]);
                }
echo json_encode(array($superrow1, $superrow2, $superrow3, $superrow4));
