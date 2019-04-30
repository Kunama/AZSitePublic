<?php
$pageName="New Invoice";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$row = $_POST['Rows'];
$Invoice = $_POST['AZ_Invoice'];
$Customer_PO = $_POST['Customer_PO'];
$Invoice_Date = $_POST['Invoice_Date'];
$Delivery_Method = $_POST['Delivery_Method'];
$Payment_Terms = $_POST['Payment_Terms'];
$Delivery_Terms = $_POST['Delivery_Terms'];
$Shipping_Address_ID = $_POST['Shipping_Address_ID'];
$Cold_Storage = $_POST['Cold_Storage'];
$Container = $_POST['Container'];
$Bill_Of_Lading = $_POST['Bill_Of_Lading'];
$query = $myPDO->prepare("INSERT INTO `Invoices` (`AZ INVOICE`, `CUSTOMER PO`, `Invoice Date`, `Delivery Method`, `Payment Terms`, `Delivery Terms`, `Shipping Address ID`, `Cold Storage`, `Container`, `Bill of Lading`) VALUES (:invoiceAZ, :po, :invoicedate, :dm, :pt, :dt, :said, :cs, :container, :bol)");
$query->bindParam(':invoiceAZ', $Invoice, PDO::PARAM_STR, 12);
$query->bindParam(':po', $Customer_PO, PDO::PARAM_STR, 12);
$query->bindParam(':invoicedate', $Invoice_Date, PDO::PARAM_STR, 12);
$query->bindParam(':dm', $Delivery_Method, PDO::PARAM_STR, 12);
$query->bindParam(':pt', $Payment_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':dt', $Delivery_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':said', $Shipping_Address_ID, PDO::PARAM_STR, 12);
$query->bindParam(':cs', $Cold_Storage, PDO::PARAM_STR, 12);
$query->bindParam(':container', $Container, PDO::PARAM_STR, 12);
$query->bindParam(':bol', $Bill_Of_Lading, PDO::PARAM_STR, 12);
if ($query->execute()){
//  echo "Success!";
}
else{
  //print_r($query->errorInfo());
  $_SESSION['error']="true";
}
for($i=0; $i<=$row; $i++){
  $query = $myPDO->prepare("INSERT INTO `Invoice_Items` (`AZ INVOICE`, `AZ PO`, `ItemID`, `No of Cartons`, `Price Per LB`) VALUES (:invoice, :po, :item, :cartons, :price)");
  $po = $_POST['AZ_PO_' . $i];
  $item = $_POST['Item_ID_' . $i];
  $cartons = $_POST['Cartons_' . $i];
  $price = $_POST['Price_' . $i];
  $query->bindParam(':invoice', $Invoice, PDO::PARAM_STR, 12);
  $query->bindParam(':po', $po, PDO::PARAM_STR, 12);
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
redirect('invoices.php');


?>
