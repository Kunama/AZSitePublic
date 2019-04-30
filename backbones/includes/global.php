<?php
$siteName = "AZGems";
try{
$myPDO = new PDO('mysql:host=localhost;dbname=AZG', '', '');
} catch(PDOException $e){
  $myPDO = new PDO('mysql:host=localhost;dbname=AZG', '', '');
}
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}
?>
