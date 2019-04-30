<?php
$pageName="New Supplier Invoice";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$row = $_POST['Rows'];
$Supplier_Invoice_ID = $_POST['Supplier_Invoice_ID'];
$AZ_PO = $_POST['AZ_PO'];
$Supplier_ID = $_POST['Supplier_ID'];
$ICIC_Number = $_POST['ICIC_Number'];
$Payment_Terms = $_POST['Payment_Terms'];
$Delivery_Terms = $_POST['Delivery_Terms'];
$Container_Number = $_POST['Container_Number'];
$Bill_of_Lading = $_POST['Bill_of_Lading'];
$Notes = $_POST['Notes'];

$query = $myPDO->prepare("INSERT INTO `Supplier_Invoice` (`Supplier Invoice ID`, `AZ PO`, `Supplier ID`, `ICIC Number`, `Payment Terms`, `Delivery Terms`, `Container No`, `Bill of Lading`, `Notes`) VALUES (:Supplier_Invoice_ID, :AZ_PO, :Supplier_ID, :ICIC_Number, :Payment_Terms, :Delivery_Terms, :Container_Number, :Bill_of_Lading, :Notes)");
$query->bindParam(':Supplier_Invoice_ID', $Supplier_Invoice_ID, PDO::PARAM_STR, 12);
$query->bindParam(':AZ_PO', $AZ_PO, PDO::PARAM_STR, 12);
$query->bindParam(':Supplier_ID', $Supplier_ID, PDO::PARAM_STR, 12);
$query->bindParam(':ICIC_Number', $ICIC_Number, PDO::PARAM_STR, 12);
$query->bindParam(':Payment_Terms', $Payment_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':Delivery_Terms', $Delivery_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':Container_Number', $Container_Number, PDO::PARAM_STR, 12);
$query->bindParam(':Bill_of_Lading', $Bill_of_Lading, PDO::PARAM_STR, 12);
$query->bindParam(':Notes', $Notes, PDO::PARAM_STR, 12);

if ($query->execute()){
//  echo "Success!";
}
else{
  //print_r($query->errorInfo());
  $_SESSION['error']="true";
}
for($i=0; $i<=$row; $i++){
  $query = $myPDO->prepare("INSERT INTO `Supplier_Invoice_Items` (`Supplier Invoice ID`, `ItemID`, `No Of Cartons`, `Price Per LB`) VALUES (:Supplier_Invoice_ID, :item, :cartons, :price)");
  $item = $_POST['Item_ID_' . $i];
  $cartons = $_POST['Cartons_' . $i];
  $price = $_POST['Price_' . $i];
  $query->bindParam(':Supplier_Invoice_ID', $Supplier_Invoice_ID, PDO::PARAM_STR, 12);
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
redirect('supplier_invoice.php');


?>
