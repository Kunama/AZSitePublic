<?php
$pageName="New AZ PO";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$row = $_POST['Rows'];
$AZ_PO = $_POST['AZ_PO'];
$PO_Date = $_POST['PO_Date'];
$Supplier_ID = $_POST['Supplier_ID'];
$Delivery_Terms = $_POST['Delivery_Terms'];
$Payment_Terms = $_POST['Payment_Terms'];
$ETD = $_POST['ETD'];
$Port = $_POST['Port'];
$Notes = $_POST['Notes'];
$Shipping_Address_ID = $_POST['Shipping_Address_ID'];
$query = $myPDO->prepare("INSERT INTO `AZ_PO` (`AZ PO`, `PO Date`, `Supplier ID`, `Delivery Terms`, `Payment Terms`, `ETD`, `Port of Discharge`, `Notes`, `Shipping Address ID`) VALUES (:po, :podate, :supplierID, :dt, :pt, :etd, :port, :notes, :said)");
$query->bindParam(':po', $AZ_PO, PDO::PARAM_STR, 12);
$query->bindParam(':podate', $PO_Date, PDO::PARAM_STR, 12);
$query->bindParam(':supplierID', $Supplier_ID, PDO::PARAM_STR, 12);
$query->bindParam(':dt', $Delivery_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':pt', $Payment_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':etd', $ETD, PDO::PARAM_STR, 12);
$query->bindParam(':port', $Port, PDO::PARAM_STR, 12);
$query->bindParam(':notes', $Notes, PDO::PARAM_STR, 12);
$query->bindParam(':said', $Shipping_Address_ID, PDO::PARAM_STR, 12);
if ($query->execute()){
//  echo "Success!";
}
else{
  //print_r($query->errorInfo());
  $_SESSION['error']="true";
}
for($i=0; $i<=$row; $i++){
  $query = $myPDO->prepare("INSERT INTO `AZ_PO_Items` (`AZ PO`, `ItemID`, `No Of Cartons`, `Cost Per LB`) VALUES (:po, :item, :cartons, :price)");
  $item = $_POST['Item_ID_' . $i];
  $cartons = $_POST['Cartons_' . $i];
  $price = $_POST['Price_' . $i];
  $query->bindParam(':po', $AZ_PO, PDO::PARAM_STR, 12);
  $query->bindParam(':item', $item, PDO::PARAM_STR, 12);
  $query->bindParam(':cartons', $cartons, PDO::PARAM_STR, 12);
  $query->bindParam(':price', $price, PDO::PARAM_STR, 12);
  if ($query->execute()){
    //echo "Success!";
  }
  else{
    $_SESSION['error']="true";

    //echo "Fail!";
  }
}
redirect('az_po.php');


?>
