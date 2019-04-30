<?php
$pageName="Customer POs";
$roleNeeded=0;
include('backbones/includes/sidebar.php');

$query = $myPDO->prepare("SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` WHERE TABLE_NAME = 'Customer_PO' AND TABLE_SCHEMA = 'AZG'");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $columnlistarray[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT COUNT(*) CNT FROM `information_schema`.`COLUMNS` WHERE TABLE_NAME = 'Customer_PO' AND TABLE_SCHEMA = 'AZG'");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $number_of_columns_array[$index] = $row;
  $index++;
}
$column_count = $number_of_columns_array[0]['CNT'];

$query = $myPDO->prepare("SELECT * FROM Customer_PO");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $results_array[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT * FROM Customer_PO_Items");
$query->execute();
$list_of_AZ="";
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $list_of_AZ = $list_of_AZ.$row["Customer PO Number"];
}
?>
<div id="content">
  <div id="contentHeader">
    <h6><?php echo $pageName ?></h6>
  </div>
  <div class='metadata'>
    <label for="InvoiceDropdown">Customer PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
  <select id="InvoiceDropdown" name="InvoiceDropdown" onchange="updateFields()">
  <option value="" disabled selected>Select PO</option>
    <?php
    $index=0;
    $query = $myPDO->prepare("SELECT * FROM `Customer_PO`");
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      echo "<option value=$index>" . $row["Customer PO Number"] . "</option>";
      $index++;
    }

?>
  </select>
</div>
  <?php
  for ($input_index = 1; $input_index < $column_count; $input_index++) {
    $input_index_ID = $input_index + 1;
    $input_id = 'input' . $input_index_ID;
    $input_label = $columnlistarray[$input_index]['COLUMN_NAME'];
    $new_label = $input_label . str_repeat('&nbsp;', 10);
    echo "
      <div class='metadata'>
        <label for=$input_id>  $new_label</label>
        <input readonly type='text' id=$input_id name='$input_id'>
      </div>";
    }
  ?>
  <table id="items">
<thead>
<th>Item ID</th>
<!-- <th>Brand</th> -->
<th>Number of Cartons</th>
<th>Price Per LB</th>
</thead>
<tbody id="data-table-body">

</tbody>
</table>

<button type="button" onclick=redirectJS("new_customer_po.php") class="newFormButton">New</button>
</div>

<script>
function updateFields(){

    var Dropdown = document.getElementById("InvoiceDropdown");
    var InvoiceOptionNumber = Dropdown.options[Dropdown.selectedIndex].value;
    var column_count = <?php echo json_encode($column_count); ?>;
    var list_of_AZ_Javascript = <?php echo json_encode($list_of_AZ); ?>;


    for (fieldIndex=1; fieldIndex<column_count; fieldIndex++){
        var input = "input".concat(fieldIndex+1);
        var inputFields = document.getElementById(input);

        //inputFields.value="Test";
        var invoice_form_label_array = <?php echo json_encode($columnlistarray); ?>;
        var results_array = <?php echo json_encode($results_array); ?>;

        var column_name_single = invoice_form_label_array[fieldIndex]['COLUMN_NAME'];

        inputFields.value=results_array[InvoiceOptionNumber][column_name_single];

}
var InvoiceOptionNumber = Dropdown.options[Dropdown.selectedIndex].value;
console.log(InvoiceOptionNumber);
console.log(results_array);
var InvoiceOption = results_array[InvoiceOptionNumber]['Customer PO Number'];
console.log(InvoiceOption);
try{
var rgxp = new RegExp(InvoiceOption, "g");
var AZ_count = (list_of_AZ_Javascript.match(rgxp).length);

}
catch (e) {

console.log("No invoice named " + InvoiceOption + " in table Invoice_Items");
}

$.post('backbones/update_tables/update_table_customer_po.php', {invoice:InvoiceOption}, function(data) {
console.log(data);
var results = $.parseJSON(data);

var AZ_PO = results[0];
var ItemID = results[1];
var Number_Of_Cartons = results[2];
//var Price_Per_LB = results[3];

$('#data-table-body').html('');
for (counter=0; counter<AZ_count; counter++){
if(AZ_PO[counter]!=undefined){
$('#data-table-body').append('<tr><td><center>'+AZ_PO[counter]+'</center></td><td><center>'+ItemID[counter]+'</center></td><td><center>'+Number_Of_Cartons[counter]+'</center></td></tr>');
}
}
//SELECT SUM(`No of Cartons` * `Price Per LB`) AS total FROM Invoice_Items

return false;
});


}
</script>
</body>
</html>
