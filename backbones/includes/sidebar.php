<?php
ob_start();
session_start();
include('global.php');
if(isset($_SESSION['Role'])){
}else{
  redirect('login.php');
}
?>
<!-- CSS Styles -->
<link href="css/style.css" type="text/css" rel="stylesheet" media="screen" />
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300,300italic' rel='stylesheet' type='text/css'>
<!-- Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Redirect Script -->
<script src="backbones/scripts/redirect.js"></script>
<!-- Searchable Dropdown -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<html>
	<head>
		<title><?php echo $siteName ?> - <?php echo $pageName ?></title>
	</head>
	<body>
<div id="sidebar">
  <ul class="sidebarMain">
    <li class="userSidebar"><div class="userDisplay"><?php echo ($_SESSION['First_Name'] . ' ' . $_SESSION['Last_Name']);?></div></li>
    <button class="sidebarMenuItem">Metadata<i class="material-icons">content_copy</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="items.php">Items</a></li>
      <li><a href="addresses.php">Addresses</a></li>
      <li><a href="customers.php">Customers</a></li>
      <li><a href="suppliers.php">Suppliers</a></li>
      <li><a href="warehouses.php">Warehouses</a></li>
      <li><a href="banks.php">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Other Things<i class="material-icons">clear_all</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="invoices.php">Invoices</a></li>
      <li><a href="az_po.php">AZ POs</a></li>
      <li><a href="customer_po.php">Customer POs</a></li>
      <li><a href="supplier_invoice.php">Supplier Invoices</a></li>
    </ul>
<!--
    <button class="sidebarMenuItem">Reports<i class="material-icons">clear_all</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Analytics<i class="material-icons">trending_up</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Servers<i class="material-icons">layers</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Database<i class="material-icons">storage</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Domains<i class="material-icons">public</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Network<i class="material-icons">cloud_queue</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Alerts<i class="material-icons">notifications_none</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul>

    <button class="sidebarMenuItem">Messages<i class="material-icons">message</i></button>
    <ul class="sidebarChildMenu">
      <li><a href="#items">Items</a></li>
      <li><a href="#addresses">Addresses</a></li>
      <li><a href="#customers">Customers</a></li>
      <li><a href="#suppliers">Suppliers</a></li>
      <li><a href="#warehouses">Warehouses</a></li>
      <li><a href="#banks">Banks</a></li>
    </ul> -->

  </ul>
</div>
<div id="header">

    <a href="index.php" class="companyName">AZ<div class="secondPartName">Gems</div></a>


  <a href='logout.php'><i class="material-icons md-48 logoutButton">power_settings_new</i></a>

</div>
<script>
  var accordion = document.getElementsByClassName("sidebarMenuItem");
  for (var i = 0; i < accordion.length; i++) {
    accordion[i].onclick = function(){
      var panel = this.nextElementSibling;
      if(panel.style.maxHeight){
        panel.style.maxHeight=null;
        this.classList.toggle("active");
      }
      else{
        hideAll();
        this.classList.toggle("active");
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    }
  }
  function hideAll() {
    for (var i = 0; i < accordion.length; i++) {
      accordion[i].classList.toggle("active", false);
      accordion[i].nextElementSibling.style.maxHeight=null;
    }
  }
</script>
