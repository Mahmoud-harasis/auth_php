<?php
$host="mysql:host=localhost;dbname=authentication;";
$username="root";
$password="";


try
{$db=new PDO($host,$username);
}
catch(PDOException $e){
    $error_message="database error:";
    $error_message.= $e-> get_massage();
    echo $error_message;
}

?>