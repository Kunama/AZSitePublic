<?php
$pageName="Update Table Customer PO";
$roleNeeded=0;
ob_start();
session_start();
include('../includes/global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('../../login.php');
}
$curinvoice = $_POST['invoice'];
$query = $myPDO->prepare("SELECT * FROM `Customer_PO_Items` WHERE `Customer PO Number`=:curinvoice");
$query->bindParam(':curinvoice', $curinvoice, PDO::PARAM_STR, 12);
$query->execute();
$superrow1 = [];
//$superrow2 = [];
$superrow3 = [];
$superrow4 = [];

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                  array_push($superrow1, $row["ItemID"]);
                  //array_push($superrow2, $row["Brand"]);
                  array_push($superrow3, $row["No Of Cartons"]);
                  array_push($superrow4, $row["Unit Price"]);
                }
echo json_encode(array($superrow1, $superrow3, $superrow4));
