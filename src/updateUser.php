<?php
include_once "connexion/connexion.php";
include_once "dao/UsersDAO.php";
include_once "model/Users.php";

	$users = new Users();
	$userdao = new UsersDAO();
	$items = $userdao->read_by_id($_GET['delUser']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
	<title>Update User</title>
</head>
<body>
	<div class="container mt-4">
		<div class="row">
			<div class="col"></div>
			<div class="col-6">
				<h1 style="text-align: center" class="alert alert-info">UPDATE USER</h1>
				<form id="updateUser" action="" method="POST">
				<?php foreach ($items as $users) : ?>
					<div class="mb-2">
						<label>Nom</label>
						<input type="text" name="nom" value="<?= $users->getNom() ?>" class="form-control" required />
					</div>
					<div class="mb-2">
						<label>Prenom</label>
						<input type="text" name="prenom" value="<?= $users->getPrenom() ?>" class="form-control" required />
					</div>
					<div class="mb-2">
						<label>Username</label>
						<input type="text" name="username" value="<?= $users->getUsername() ?>" class="form-control" required />
					</div>
					<div class="mb-2">
						<label>Sexe</label>
						<select name="sex" class="form-control">
							<option value="M">Masculin</option>
							<option value="F">Feminin</option>
						</select>
					</div>
					<div class="mb-2">
						<label>Role</label>
						<select name="role" class="form-control">
							<option value="Admin">Admin</option>
							<option value="caissier">caissier</option>
						</select>
					</div>
					<div class="mb-2">
						<input type="hidden" name="id" value="<?= $users->getId() ?>" />
						<button class="btn btn-warning" type="submit">Update</button>
						<a class="btn btn-danger" href="home.php">Cancel</a>
					</div>
					<?php endforeach ?>
				</form>
			</div>
			<div class="col"></div>
		</div>
	</div>
</body>	

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="public/js/updateUser.js"></script>
</body>
</html>

