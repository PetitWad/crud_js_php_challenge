<?php 
include_once "connexion/connexion.php";
include_once "dao/UsersDAO.php";
include_once "model/Users.php";

$users = new Users();
$userdao = new UsersDAO();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Login | Challenge atalou</title>
</head>
<body class="bg-light">
<section class="vh-100" style="margin-top: 10em">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="public/image/imgLog.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <!-- <form action="controller/LogController.php" method="POST" id="logUser"> -->
        <form action="" method="POST" id="logUser">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="bi bi-facebook"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="bi bi-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="bi bi-linkedin"></i>
            </button>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4 mt-3">
            <label class="form-label" for="login_username">Username</label>
            <input type="text" name="login_username" id="login_username"  class="form-control" required />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="login_password">Password</label>
            <input type="password" name="login_password" id="login_password" class="form-control" required />
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
                <input type="submit"  class="btn btn-primary btn-block" name="login" value="LOGIN" />
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
 
    <script src="public/js/logUser.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>
