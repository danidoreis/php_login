<?php 
require 'database.php';

 $message = ''; 

//verificar campos vacios

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    //agregar datos
     
    $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
    //ejecutar consulta sql
    $stmt = $conn->prepare($sql);
    //vincula parametros
    $stmt->bindParam(':email', $_POST['email']);
    //guardo los parametros y cifra los datos en la tabla
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    
    //verificacion de ejecucion
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
     <!-- fuente -->
     <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SignUp</title>
</head>
<body>

<nav class = "navbar navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">PHP y MySQL APP </a> 
</div>
</nav>

<!-- si NO esta vacio el msj -->
<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>


<h1>SignUp</h1>
<span>Or <a href="login.php" class="btn btn-primary" role="button">Login</a></span>

<form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Your E-Mail">
        <input type="password" name="password" placeholder="Your Password">
        <!-- <input type="password" name="confirm_password" placeholder="confirm your password"> -->
        <input type="submit" value="Send">



    </form>
</body>
</html>