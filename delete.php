<?php

require_once('config.php');
$id = $_GET['id'];

$sql = " UPDATE employees
SET is_deleted = '1'
WHERE id=:id";

$stmt=$conn->prepare($sql);
if($stmt->execute([':id'=>$id])) {
  header("Location:./users.php");
} 