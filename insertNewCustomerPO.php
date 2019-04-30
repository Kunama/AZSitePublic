<?php
$pageName="New Customer PO";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$row = $_POST['Rows'];
$Customer_PO_Number = $_POST['Customer_PO_Number'];
$Customer_ID = $_POST['Customer_ID'];
$Order_Date = $_POST['Order_Date'];
$Delivery_Date = $_POST['Delivery_Date'];
$Billing_Address_ID = $_POST['Billing_Address_ID'];
$Shipping_Address_ID = $_POST['Shipping_Address_ID'];
$Payment_Terms = $_POST['Payment_Terms'];
$Delivery_Terms = $_POST['Delivery_Terms'];

$query = $myPDO->prepare("INSERT INTO `Customer_PO` (`Customer PO Number`, `Customer_ID`, `Order Date`, `Delivery Date`, `Billing Address ID`, `Shipping Address ID`, `Payment Terms`, `Delivery Terms`) VALUES (:Customer_PO_Number, :Customer_ID, :Order_Date, :Delivery_Date, :Billing_Address_ID, :Shipping_Address_ID, :Payment_Terms, :Delivery_Terms)");
$query->bindParam(':Customer_PO_Number', $Customer_PO_Number, PDO::PARAM_STR, 12);
$query->bindParam(':Customer_ID', $Customer_ID, PDO::PARAM_STR, 12);
$query->bindParam(':Order_Date', $Order_Date, PDO::PARAM_STR, 12);
$query->bindParam(':Delivery_Date', $Delivery_Date, PDO::PARAM_STR, 12);
$query->bindParam(':Billing_Address_ID', $Billing_Address_ID, PDO::PARAM_STR, 12);
$query->bindParam(':Shipping_Address_ID', $Shipping_Address_ID, PDO::PARAM_STR, 12);
$query->bindParam(':Payment_Terms', $Payment_Terms, PDO::PARAM_STR, 12);
$query->bindParam(':Delivery_Terms', $Delivery_Terms, PDO::PARAM_STR, 12);

if ($query->execute()){
//  echo "Success!";
}
else{
  //print_r($query->errorInfo());
  $_SESSION['error']="true";
}
for($i=0; $i<=$row; $i++){
  $query = $myPDO->prepare("INSERT INTO `Customer_PO_Items` (`Customer PO Number`, `ItemID`, `No Of Cartons`, `Unit Price`) VALUES (:Customer_PO_Number, :item, :cartons, :price)");
  $item = $_POST['Item_ID_' . $i];
  $cartons = $_POST['Cartons_' . $i];
  $price = $_POST['Price_' . $i];
  $query->bindParam(':Customer_PO_Number', $Customer_PO_Number, PDO::PARAM_STR, 12);
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
redirect('customer_po.php');


?>
