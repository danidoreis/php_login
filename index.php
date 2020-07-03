<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
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
    <title>Welcome</title>
</head>
<body>



<?php if(!empty($user)): ?>
  <nav class = "navbar navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">PHP y MySQL APP </a> <a href="loguot.php" class="btn btn-danger" role="button">
        Logout
      </a>
</div>
</nav>
      <br><h3>Welcome.</h3> <h5> <?= $user['email']; ?></h5>
      <br>You are Successfully Logged In

      
    <?php else: ?>
     
      
            <h1>Please Login or SignUp</h1>

     
<a href="login.php" class="btn btn-primary" role="button" >Login </a> Or
<a href="signup.php" class="btn btn-primary" role="button" > SignUp</a>

         
          </div>
        </div>
      </div>
    </header>

     
    <?php endif; ?>

   
</body>
</html>