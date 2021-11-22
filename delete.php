<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
  include "conection_database.php";
  $sql = "DELETE FROM `news` WHERE `news`.`Id` = ?";
  $conn->prepare($sql)->execute([$_POST['id']]);
  echo "id = ".$_POST['id'];
}
?>
