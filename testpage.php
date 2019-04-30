<!-- select `ItemID`
from `AZ_PO_Items`
group by `ItemID`
order by count(*) desc -->
<?php
$pageName="Page for Testing";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
?>
<div id="content">
  <div id="contentHeader">
    <h6><?php echo $pageName ?></h6>
  </div>
<input list="items" type="text" id="item" name="item" oninput="updateItemsDropdown()"/>
<datalist id="items">
<option value="O">
<option value="Opera">Opera</option>
<option value="Apera">
</datalist>


</div>
<script>
function updateItemsDropdown(){
  var inputItem = $('#item').val();
  if (inputItem.length>4){
    console.log(inputItem.length);
  }
  else{
    console.log("Too short");
  }
}
</script>
</body>
</html>
