<?php
include('includes/sidebar.php');

$query = $myPDO->prepare("SELECT * FROM $pageName");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $itemsArray[$index] = $row;

  $index++;
}

$query = $myPDO->prepare("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = '".$pageName."'");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $columnlistarray[$index]=$row;
  $index++;
}

$query = $myPDO->prepare("SELECT COUNT(*) CNT FROM `information_schema`.`COLUMNS` WHERE TABLE_NAME = '".$pageName."' AND TABLE_SCHEMA = 'AZG'");
$query->execute();
$index=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
  $number_of_columns_array[$index]=$row;
  $index++;
}
$column_count = $number_of_columns_array[0]['CNT'];
?>
		<div id="content">
			<div id="contentHeader">
				<h6><?php echo $pageName ?></h6>
			</div>
      <?php
      for ($input_index = 0; $input_index < $column_count; $input_index++) {
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
$newPageName = substr(strtolower($pageName), 0, -1);

?>
<div class="metadataButtons">
<div class="prevButton"><button type="button" onclick=recordBrowser(-1)>Previous</button></div>
<div class="nextButton"><button type="button" onclick=recordBrowser(1)>Next</button></div>
<div class="nextButton"><button type="button" onclick=redirectJS("new_<?php echo $newPageName ?>.php")>New</button></div>
</div>
		</div>
    <script>
var rowcounter = 0;
var columnVal = <?php echo json_encode($itemsArray); ?>;
var COUNTER = <?php echo json_encode($column_count); ?>;
for (i=0; i<COUNTER; i++) {
     var columnName = <?php echo json_encode($columnlistarray); ?>;

     var test = columnName[i];
     var test1 = JSON.stringify(test);
     var test2 = test1.substring(test1.indexOf(":")+2, 50);
     var test3 = test2.substring(0, test2.length-2);

     var inp = "input";
     var inputx = inp.concat(i + 1);
     var input1test = document.getElementById(inputx);
     input1test.value = columnVal[rowcounter][test3];
}

function recordBrowser(delta){
    rowcounter=rowcounter+delta;
    if (rowcounter>=columnVal.length){
        rowcounter=0;
    }
    if (rowcounter<0){
        rowcounter=columnVal.length-1;
    }


    for (i=0; i<COUNTER; i++) {
     var columnName = <?php echo json_encode($columnlistarray); ?>;
     var test = columnName[i];
     var test1 = JSON.stringify(test);
     var test2 = test1.substring(test1.indexOf(":")+2, 50);
     var test3 = test2.substring(0, test2.length-2);
     var inp = "input";
     var inputx = inp.concat(i + 1);
     var input1test = document.getElementById(inputx);
     input1test.value = columnVal[rowcounter][test3];

}
}
</script>
	</body>
</html>
