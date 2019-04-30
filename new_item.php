<?php
$pageName="New Item";
$roleNeeded=0;
include('backbones/includes/sidebar.php');
$query = $myPDO->prepare("SELECT `Item_Size` FROM `Item_Size`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $sizeArray[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT `Item_Size` FROM `Item_Size`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $sizeArray[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT `brand` FROM `Brand`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $brandArray[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT `package` FROM `Package`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $packageArray[$index] = $row;
  $index++;
}

$query = $myPDO->prepare("SELECT `species` FROM `Species`");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $speciesArray[$index] = $row;
  $index++;
}

?>
<div id="content">
  <div id="contentHeader">
    <h6><?php echo $pageName ?></h6>
  </div>
  <?php if(isset($_SESSION['error'])) :
    unset($_SESSION['error']);?>
    <div id="error">
      <h3>This item is already in the database</h3>
    </div>
  <?php endif; ?>
<form action="insertNewItem.php" method="post" onSubmit="return validateMe()">
  <div class="selects">
    <select name="itemSize" id="itemSize">
  <option selected="selected" disabled value=''>Choose size</option>
  <?php
    foreach($sizeArray as $option) { ?>
      <option value="<?php echo $option['Item_Size'] ?>"><?php echo $option['Item_Size'] ?></option>
  <?php
} ?>
</select>
<br />
<select name="package" id="package">
  <option selected="selected" disabled value=''>Choose package</option>
  <?php
    foreach($packageArray as $option) { ?>
      <option value="<?php echo $option['package'] ?>"><?php echo $option['package'] ?></option>
  <?php
    } ?>
</select>
<br />
<select name="species" id="species">
  <option selected="selected" disabled value=''>Choose species</option>
  <?php
    foreach($speciesArray as $option) { ?>
      <option value="<?php echo $option['species'] ?>"><?php echo $option['species'] ?></option>
  <?php
    } ?>
</select>
<br />
<select name="brand" id="brand">
  <option selected="selected" disabled value=''>Choose brand</option>
  <?php
    foreach($brandArray as $option) { ?>
      <option value="<?php echo $option['brand'] ?>"><?php echo $option['brand'] ?></option>
  <?php
    } ?>
</select>
</div>

<input class="formSubmit" type="submit" value = "Submit" />
</form>
</div>
</body>
<script>
$(document).ready(function() {
    $('#package').select2({width:'40%'});
    $('#itemSize').select2({width:'40%'});
    $('#brand').select2({width:'40%'});
    $('#species').select2({width:'40%'});
});
function validateMe(){
  var brandValue = document.getElementById("brand").value;
  var speciesValue = document.getElementById("species").value;
  var packageValue = document.getElementById("package").value;
  var itemSizeValue = document.getElementById("itemSize").value;
  if (brandValue == '' || speciesValue == '' || packageValue == '' || itemSizeValue == '') {
          alert("Please select a value for each dropdown");
          return false;
      }
      return true;
}
</script>
</html>
