<?php
$pageName="New Invoice";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$query = $myPDO->prepare("SELECT * FROM `AZ_PO`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $AZ_PO_Array[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT * FROM `AZ_PO_Items`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $AZ_PO_Items_Array[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT DISTINCT ItemID FROM `AZ_PO_Items`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $Items_Array[$index] = $row;
  $index++;
}

?>
<div id="content">
  <div id="contentHeader">
    <h6><?php echo $pageName ?></h6>
  </div>
<form action="insertNewInvoice.php" method="post" onSubmit="return validateForm()">
  <div class='metadata'>
    <label for="AZ_Invoice">AZ Invoice</label>
    <input type='text' id="AZ_Invoice" name='AZ_Invoice'>
  </div>
  <div class='metadata'>
    <label for="Customer_PO">Customer PO</label>
    <input type='text' id="Customer_PO" name='Customer_PO'>
  </div>
  <div class='metadata'>
    <label for="Invoice_Date">Invoice Date</label>
    <input type='date' id="Invoice_Date" name='Invoice_Date'>
  </div>
  <div class='metadata'>
    <label for="Delivery_Method">Delivery Method</label>
    <input type='text' id="Delivery_Method" name='Delivery_Method'>
  </div>
  <div class='metadata'>
    <label for="Payment_Terms">Payment Terms</label>
    <input type='text' id="Payment_Terms" name='Payment_Terms'>
  </div>
  <div class='metadata'>
    <label for="Delivery_Terms">Delivery Terms</label>
    <input type='text' id="Delivery_Terms" name='Delivery_Terms'>
  </div>
  <div class='metadata'>
    <label for="Shipping_Address_ID">Shipping Address ID</label>
    <input type='text' id="Shipping_Address_ID" name='Shipping_Address_ID'>
  </div>
  <div class='metadata'>
    <label for="Cold_Storage">Cold Storage</label>
    <input type='text' id="Cold_Storage" name='Cold_Storage'>
  </div>
  <div class='metadata'>
    <label for="Container">Container</label>
    <input type='text' id="Container" name='Container'>
  </div>
  <div class='metadata'>
    <label for="Bill_Of_Lading">Bill of Lading</label>
    <input type='text' id="Bill_Of_Lading" name='Bill_Of_Lading'>
  </div>
  <table id="items" class="newItems">
  <thead>
  <th>AZ PO</th>
  <th>Item ID</th>
  <th>Number of Cartons</th>
  <th>Price Per LB</th>
  </thead>
  <tbody id="data-table-body">
    <tr>
      <td>
        <select name="AZ_PO_0" id="AZ_PO_0" class="newItemsTableSelect" onchange='updateItems(0)'>
          <option selected="selected" disabled value=''>Choose PO</option>
        <?php
        foreach($AZ_PO_Array as $option){?>
          <option value="<?php echo $option['AZ PO'] ?>"><?php echo $option['AZ PO'] ?></option>
      <?php
      } ?>
    </select>
      </td>
      <td>
        <select name="Item_ID_0" id="Item_ID_0" class="newItemsTableSelect" onchange='updatePOs(0)'>
          <option selected="selected" disabled value=''>Choose Item</option>
        <?php
        foreach($Items_Array as $option){?>
          <option value="<?php echo $option['ItemID'] ?>"><?php echo $option['ItemID'] ?></option>
      <?php
      } ?>
    </select>
      </td>
      <td>
        <input type='text' name='Cartons_0' id='Cartons_0' class='newItemsTableInput Cartons' oninput="inputValidationInventory(0)" onchange="inputValidationInventory(0)" onclick="inventoryCheck(0)"/>
      </td>
      <td>
        <input type='text' name='Price_0' class='newItemsTableInput'/>
      </td>
    </tr>
  </tbody>
  </table>
  <input type="text" id='Rows' name='Rows' hidden />
<input class="formSubmit" type="submit" value = "Submit" />
<button class="newRowButton" type="button" onclick="newRow()">New Row</button>
<button class="newRowButton" type="button" onclick="delRow()">Delete Row</button>
</form>
</div>
<script>
var row=0;
var error = true;
var CartonsInventory=0;
function updatePOs(row){
  $("#AZ_PO_" + row + " option[value!='']").remove();
  var item = $("#Item_ID_" + row).val();
  console.log(item);

  var item = $("#Item_ID_" + row).val();
  console.log(item);
  $.post('backbones/update_tables/update_table_new_invoice_pos.php', {item:item}, function(data) {
   console.log(data);
   var results = $.parseJSON(data);
   var option = '';
   for (var i=0; i<results.length; i++){
     option += '<option value="' + results[i] + '">' + results[i] + '</option>';
   }
   $("#AZ_PO_" + row).empty().append(option);
  });
}
function updateItems(row){
  var po = $("#AZ_PO_" + row).val();
  console.log(po);
  $.post('backbones/update_tables/update_table_new_invoice_items.php', {po:po}, function(data) {
   console.log(data);
   var results = $.parseJSON(data);
   var option = '';
   for (var i=0; i<results.length; i++){
     option += '<option value="' + results[i] + '">' + results[i] + '</option>';
   }
   $("#Item_ID_" + row).empty().append(option);
  });
}

$(document).ready(function() {
    $('.newItemsTableSelect').select2({width:'100%'});
});
function newRow(){
  error=true;
  row+=1;
  console.log(row);
  var AZ_PO_Array = <?php echo json_encode($AZ_PO_Array) ?>;
  var Items_Array = <?php echo json_encode($Items_Array) ?>;
  console.log(AZ_PO_Array);
  var optionsForAZPO = '';
  for (var i=0; i<AZ_PO_Array.length; i++){
    optionsForAZPO += '<option value="' + AZ_PO_Array[i]['AZ PO'] + '">' + AZ_PO_Array[i]['AZ PO'] + '</option>';
  }
  var optionsForItems = '';
  for (var i=0; i<Items_Array.length; i++){
    optionsForItems += '<option value="' + Items_Array[i]['ItemID'] + '">' + Items_Array[i]['ItemID'] + '</option>';
  }
  console.log(optionsForAZPO);
  console.log(optionsForItems);
  var Table = document.getElementById('data-table-body');
  var tableRow = document.createElement('tr');
  $('#items tr:last').after('<tr><td><select name="AZ_PO_' + row + '" id="AZ_PO_'+row+'" class="newItemsTableSelect" onchange="updateItems('+row+')"><option selected="selected" disabled value="">Choose PO</option>'+optionsForAZPO+'</select></td><td><select name="Item_ID_'+row+'" id="Item_ID_'+row+'" class="newItemsTableSelect" onchange="updatePOs('+row+')"><option selected="selected" disabled value="">Choose Item</option>'+optionsForItems+'</select></td><td><input type="text" name="Cartons_'+row+'" id="Cartons_'+row+'" class="newItemsTableInput" oninput="inputValidationInventory('+row+')" onchange="inputValidationInventory('+row+')" onclick="inventoryCheck('+row+')"/></td><td><input type="text" name="Price_'+row+'" class="newItemsTableInput"/></td></tr>');
  $(document).ready(function() {
      $('.newItemsTableSelect').select2({width:'100%'});
  });
}
function delRow(){
  if(row<=0){
    console.log("STOP!");
  }
  else{
    $('#items tr:last').remove();
    row-=1;
  }
}
function inputValidationInventory(row){
  var CartonsInput = $("#Cartons_"+row).val();
  console.log(CartonsInput);
  //var CartonsInventory = 300;
  if(CartonsInput<=CartonsInventory){
    $("#Cartons_"+row).css("background-color","white");
    error=false;
    console.log("Less");
  }
  else{
    $("#Cartons_"+row).css("background-color","RGBA(255,0,0,0.25)");
    error=true;
    console.log("error");
  }
}


function validateForm(){
  console.log("Function called");
  if (error==false){
    console.log("TRUE");
    $("#Rows").val(row);
    //console.log(row);
    return true;
  }
  else{
    alert("There was a problem, please make sure everything is correct");
    return false;
  }
}
function inventoryCheck(row){
  var po = $("#AZ_PO_" + row).val();
  var item = $("#Item_ID_" + row).val();
  $.post('backbones/update_inventory/update_inventory_invoice.php', {po:po, item:item}, function(data) {
    console.log(data);
    var result = data.substring(1, data.length-1);
    CartonsInventory = parseInt(result);
    console.log(CartonsInventory);
  });

}


</script>
</body>
</html>
