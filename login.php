<?php
require_once "./config.php";
$password = $_POST["password"] ?? null;
$email = $_POST["email"] ?? null;
$query='SELECT * FROM users WHERE password= :password and email = :email';
$stmt=$db->prepare($query);
$stmt->bindValue(':password', $password);
$stmt->bindValue(':email', $email);
$stmt->execute();
$user=$stmt->fetch(PDO::FETCH_ASSOC);

// Shaima1234
// shaima.alshlouh@gmail.com
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// echo "<pre>";
// var_dump($user) . "13";
// echo "</pre>";
// echo "<pre>";
// echo is_array($user) . "16";

if(is_array($user) && !empty($_POST)){
    $d = date("Y-m-d");
    $query = "UPDATE users SET datelastLogin = :d WHERE id = 1";
    $stmt=$db->prepare($query);
    $stmt->bindValue(':d', $d);
    $stmt->execute();
    if($user["fname"] === "shaima"){
        header("Location:http://localhost/auth_php/users.php/");
    }else{
        echo "hello " . $user["fname"] . "<br>";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">

    <title>sign up</title>
  </head>
  <style>
.error {color: #FF0000;}
</style>
  <body>

    <div class="container">
    <h1>Log In</h1>

<form action="" method="post">

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Email" name="email">
    <!-- <p class="error"></p> -->
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password:</label>
  <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Write the Password" name="password">
  <!-- <p class="error"></p> -->

</div>



<div class="mb-3">
  <input type="submit" class="btn btn-primary">
</div>
</form>

  </div>
  </body>
</html>