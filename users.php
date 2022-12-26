<?php 
require_once('./config.php');
$query='SELECT * FROM users';
$stmt= $db->prepare($query) ;
$stmt->execute();
$users=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
<h1 class="mb-5">Users</h1>

<table class="table">
    
  <thead> 
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">password</th>
      <th scope="col">date created </th>
      <th scope="col">date last login</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
        <?php
        foreach($users as $user){
        ?>

          <tr>
        
        <th scope="row"><?PHP echo $user['id']?></th>
        <td><?PHP echo $user['fname'] ?></td>
        <td><?PHP echo $user['email']?></td>
        <td><?PHP echo $user['password']?></td>
        <td><?PHP echo $user['dateCreated'] ?></td>
        <td><?PHP echo $user['datelastLogin'] ?></td>

        <td>
                  <a href="update.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>

                  <form method="post" action="delete.php" style="display: inline-block">
                      <input  type="hidden" name="id" value="<?php echo $user['id'] ?>"/>
                      <a href="delete.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-danger">Delete</a>

                  </form>
              </td>
  
      </tr>
      <?php }?>
      
     
    
  </tbody>
</table>
</div>
</body>
</html>