<?php
//fucion session
  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /xampp/php-mysql-login-app');
  }
  require 'database.php';

//verificar si el campo no esta vacio
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
      
    //consulta a BD
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email = :email');
    
    //verifica los parametros
    $records->bindParam(':email', $_POST['email']);
    $records->execute();

    //obtengo los datos del usuarios
    $results = $records->fetch(PDO::FETCH_ASSOC);

// mandamos los datos
    $message = '';

//si no esta vacio el campo y comparo las contrase;as
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
    header("Location: /xampp/php-mysql-login-app"); 
    } else {
      $message = 'Sorry, those credentials do not match';
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
    <title>Login</title>
</head>
<body>
    
<nav class = "navbar navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">PHP y MySQL APP </a> 
</div>
</nav>
<!-- verifica si el msj no esta vacio -->

<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>Or <a href="signup.php" class="btn btn-primary" role="button">SignUp</a></span>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Your Mail">
        <input type="password" name="password" placeholder="Your Password">
        <input type="submit" value="Send">



    </form>
</body>
</html>