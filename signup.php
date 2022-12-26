<?php
require_once "./config.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$nameErr = "";
$emailErr = "";
$erorrs = [];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fname"]) && isset($_POST["middleName"]) && isset($_POST["lastName"]) && isset($_POST["familyName"]) && isset($_POST["dateBirth"])  && isset($_POST["mobile"]) && isset($_POST["email"])&& isset($_POST["password"]) && isset($_POST["confirm"])){
    $firstname=$_POST['fname'];
    $middlename=$_POST['middleName'];
    $lastname=$_POST['lastName'];
    $familyname=$_POST['familyName'];
    $datebirth=$_POST['dateBirth'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confpassword=$_POST['confirm'];

        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
          $nameErr = "Only letters and white space allowed";
          $erorrs["firstname"] = "Enter Your first name";
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/",$middlename)) {
          $erorrs["middlename"] = "Enter Your middle name";
          }
          if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
          $erorrs["lastName"] = "Enter Your last name";
          }
          if (!preg_match("/^[a-zA-Z-' ]*$/",$familyname)) {
          $erorrs["familyName"] = "Enter Your family name";
          }
          if (!preg_match("/^(\+?){1}\d{14}$/",$mobile)) {
          $erorrs["mobile"] = "Enter Your mobile number";
          }

        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erorrs["email"] = "Enter Your email";
        }

        if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$password)) {
            $erorrs["password"] = "Enter Your password";
          }

          if (!preg_match("/^(([0-9]{1,2})\/)+(([0-9]{1,2})\/)+([0-9]{4})$/",$datebirth)) {
            $erorrs["dateBirth"] = "Enter Your date birth";

          }
        if($password != $confpassword){
            $erorrs["confirm"] = "your password didn't match";
        }

    //   print_r($erorrs);

      if(empty($erorrs)){
        $query = 'INSERT INTO users SET fname = :fname, middleName = :middleName, lastName = :lastName, familyName = :familyName, dateBirth = :dateBirth,
mobile = :mobile, password = :password, email = :email';
$statement=$db->prepare($query);
$statement->bindValue(':fname', $firstname);
$statement->bindValue(':middleName', $middlename);
$statement->bindValue(':lastName', $lastname);
$statement->bindValue(':familyName', $familyname);
$statement->bindValue(':dateBirth', $datebirth);
$statement->bindValue(':mobile', $mobile);
$statement->bindValue(':email', $email);
$statement->bindValue(':password', $password);

$statement->execute();
header("Location:http://localhost/auth_php/login.php/");

      }
    

}


// ^(([0-9]{2})\/)+(([0-9]{2})\/)+([0-9]{4})$
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
    <h1>sign up</h1>

<form action="" method="post">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">First Name:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the First Name" name="fname">
  <p class="error"><?php echo $erorrs['firstname'] ?? null;?></p>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Middle Name:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Middle Name" name="middleName">
  <p class="error"><?php echo $erorrs['middlename'] ?? null;?></p>
  
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Last Name:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Last Name" name="lastName">
  <p class="error"><?php echo $erorrs['lastName'] ?? null;?></p>

</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Family Name:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Family Name" name="familyName">
  <p class="error"><?php echo $erorrs['familyName'] ?? null;?></p>

</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Date Birth:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Date Birth" name="dateBirth">
  <p class="error"><?php echo $erorrs['dateBirth'] ?? null;?></p>

</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Mobile:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Mobile Number" name="mobile">
  <p class="error"><?php echo $erorrs['mobile'] ?? null;?></p>

</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email:</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Write the Email" name="email">
  <p class="error"><?php echo $erorrs['email'] ?? null;?></p>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password:</label>
  <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Write the Password" name="password">
  <p class="error"><?php echo $erorrs['password'] ?? null;?></p>

</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Confirm Password:</label>
  <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Write the Password" name="confirm">
  <p class="error"><?php echo $erorrs['confirm'] ?? null;?></p>

</div>

<div class="mb-3">
  <input type="submit" class="btn btn-primary">
</div>
</form>

  </div>
  </body>
</html>