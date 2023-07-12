<?php
include_once "connexion/connexion.php";
include_once "dao/UsersDAO.php";
include_once "dao/ProductDao.php";
include_once "model/Users.php";
include_once "model/Product.php";

if (!isset($_SESSION['user'])) {
	header('location:index.php');
} else {
	$users = new Users();
	$prod = new Product();
	$userdao = new UsersDAO();
	$proddao = new ProductDao();

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<title>Manage Users</title>
	</head>

	<body>
		<div class="container-fluid">
			<?php foreach ($userdao->tcheck_user() as $users) : ?>
				<nav class="navbar navbar-light bg-light menu">
					<div class="container">
						<a class="navbar-brand" href="#">Challenge AtALOU</a>
						<a class="btn  btn-info btn-sm" href="./logout.php">Logout</a>
					</div>
				</nav><br><br>
				<?php if ($users->getRole() == 'Admin') : ?>

					<h2 style="text-align: center;">USER AND PRODUCT MANAGEMENT</h2>

					<!-- division du tableau et le formulaire -->
					<p class="alert alert-secondary"><button id="toggleFirstSection" class="btn btn-info">SHOW | HIDE</button></p>
					<div class="container-fluid" id="firstSection">
						<div class="row">
							<div class="col-4">
								<form action="controller/CreateUserCrt.php" method="POST">
									<div class="mb-2">
										<label>Nom</label>
										<input type="text" name="nom" value="" autofocus class="form-control" required />
									</div>
									<div class="mb-2">
										<label>Prenom</label>
										<input type="text" name="prenom" value="" class="form-control" required />
									</div>

									<div class="mb-2">
										<label>Username</label>
										<input type="text" name="username" value="" class="form-control" required />
									</div>

									<div class="mb-2">
										<label>Password</label>
										<input type="password" name="password" value="" class="form-control" required />
									</div>

									<div class="mb-2">
										<label>Role</label>
										<select name="role" class="form-control">
											<option value="Admin">Admin</option>
											<option value="caissier">caissier</option>
										</select>
									</div>
									<div class="mb-2">
										<label>Sex</label>
										<select name="sex" class="form-control">
											<option value="M">Masculin</option>
											<option value="F">Feminin</option>
										</select>
									</div>
									<div class="mb-2">
										<br>
										<button class="btn btn-primary" type="submit" name="submit">SAVE</button>
									</div>
								</form>
							</div>
							<div class="col-8">
								<!-- le tableau --><br>
								<div class="table-responsive">
									<table class="table table-sm table-bordered table-hover">
										<thead>
											<tr>
												<th>Id</th>
												<th>Nom</th>
												<th>Prenom</th>
												<th>Username</th>
												<th>Sex</th>
												<th class="pl-2">Action</th>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($userdao->read() as $users) : ?>
												<tr>
													<td><?= $users->getId() ?></td>
													<td><?= $users->getNom() ?></td>
													<td><?= $users->getPrenom() ?></td>
													<td><?= $users->getUsername() ?></td>
													<td><?= $users->getSex() ?></td>
													<td class="pl-2">
														<button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $users->getId() ?>">
															<i class="bi bi-pen-fill"></i>
														</button>
														<button class="btn btn-danger btn-sm" title="Delete User" data-toggle="modal" data-target="#del><?= $users->getId() ?>">
															<i class="bi bi-person-x-fill"></i>
														</button>
														<?php if ($users->getStatut() == 1) { ?>
															<button class="btn btn-info btn-sm" title="Lock User" data-toggle="modal" data-target="#desac><?= $users->getId() ?>">
																<i class="bi bi-unlock-fill"></i>
															</button>
														<?php } else { ?>
															<button class="btn btn-info btn-sm" title="Unlock User" data-toggle="modal" data-target="#activ><?= $users->getId() ?>">
																<i class="bi bi-lock-fill"></i>
															</button>
														<?php } ?>
													</td>
												</tr>
												<!-- Modal Update user -->
												<div class="modal fade" id="editar><?= $users->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">***UPDATE USER***</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form action="controller/UpdateUserCrt.php" method="POST">
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
																		<label>Role</label>
																		<select name="role" class="form-control">
																			<option value="Admin">Admin</option>
																			<option value="caissier">caissier</option>
																		</select>
																	</div>
																	<div class="mb-2">
																		<input type="hidden" name="id" value="<?= $users->getId() ?>" />
																		<button class="btn btn-primary" type="submit" name="edit">Update</button>
																	</div>
															</div>
															</form>
														</div>
													</div>
												</div>
											</div>
								<!-- Modal activation, desactivation et suppression d'un utilisateur -->
								<!-- modal desactiver -->
								<div class="modal fade" id="desac><?= $users->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">***lOCK USER***</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="controller/RoleUserCrt.php" method="POST">
													<h4>Are you sure to Lock this account <strong><?= $users->getUsername() ?></strong></h4>
													<div class="row">
														<div class="col-md-2">
															<input type="hidden" name="id" value="<?= $users->getId() ?>" />
															<button class="btn btn-primary" type="submit" name="desac">Lock <i class="bi bi-lock-fill"></i></button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- modal activer -->
								<div class="modal fade" id="activ><?= $users->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">***UNLOCK USER***</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="controller/RoleUserCrt.php" method="POST">
													<h4>Are you sure to Unlock this account <strong><?= $users->getUsername() ?></strong></h4>
													<div class="row">
														<div class="col-md-2">
															<input type="hidden" name="id" value="<?= $users->getId() ?>" />
															<button class="btn btn-primary" type="submit" name="activ">Unlock <i class="bi bi-unlock-fill"></i></button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- Modal de suppression  -->
								<div class="modal fade" id="del><?= $users->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">***DELETE USER***</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<h4>⚠️Etes-vous sur de vouloir supprimer le compte de <strong><?= $users->getUsername() ?></strong></h4>
												<a class="btn btn-danger" href="controller/DeleteUserCrt.php?del=<?= $users->getId() ?>">Delete <i class="bi bi-person-x-fill"></i></a>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							</tbody>
							</table>
							</div>
						</div>
					</div>
				</div><br><br> <!--  End of first part -->
				<h2 style="text-align: center;">ALL OF PRODUCT</h2>
			<p class="alert alert-secondary"><button id="toggleSecondSection" class="btn btn-info">SHOW | HIDE</button></p>
		<div id="secondSection" class="container-fluid pl-3">
			<div class="row">
				<div class="col-4">
					<h2 class="alert alert-primary">Add a new product</h2>
					<form action="controller/CreateProd.php" method="POST">
						<div class="form-group">
							<label for="nomProduit">Nom du produit:</label>
							<input type="text" class="form-control" id="nomProduit" name="nomProduit">
							<label for="prix">Prix:</label>
							<input type="text" class="form-control" id="prix" name="prix">
							<label for="description">Description:</label>
							<textarea class="form-control" id="description" name="description"></textarea>
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Add</button>
					</form>
				</div>					
				<div class="col-8">
				<!-- le tableau --><br>
				<div class="table-responsive">
					<table class="table table-sm table-bordered table-hover">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name of product</th>
								<th>Prix</th>
								<th>Description</th>
								<th class="pl-2">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($proddao->read() as $prod) : ?>
							<tr>
								<td><?= $prod->getId() ?></td>
								<td><?= $prod->getNomProduit() ?></td>
								<td><?= $prod->getPrix() ?></td>
								<td><?= $prod->getDescription() ?></td>
								<td class="pl-2">
									<button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#updProd><?= $prod->getId() ?>">
										<i class="bi bi-pen-fill"></i>
									</button>
									<button class="btn btn-danger btn-sm" title="Delete User" data-toggle="modal" data-target="#delProd><?= $prod->getId() ?>">
										<i class="bi bi-trash3-fill"></i>
									</button>
								</td>
							</tr>
							<!-- Modal Update product -->
							<div class="modal fade" id="updProd><?= $prod->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">***UPDATE PRODUCT***</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="controller/UpdateProduct.php" method="POST">
												<label for="nomProduit">Nom du produit:</label>
												<input type="text" class="form-control" value="<?= $prod->getNomProduit() ?>" id="nomProduit" name="nomProduit">
												<label for="prix">Prix:</label>
												<input type="text" class="form-control" value="<?= $prod->getPrix() ?>" id="prix" name="prix">
												<label for="description">Description:</label>
												<textarea class="form-control" value="" id="description" name="description"><?= $prod->getDescription() ?></textarea>
												<input type="hidden" name="id" value="<?= $prod->getId() ?>" />
												<button class="btn btn-primary" type="submit" name="updateProd">Update</button>
											</form>
										</div>
									</div>
								</div>
							</div>				
							<!-- Modal de suppression  -->
							<div class="modal fade" id="delProd><?= $prod->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">***DELETE PRODUCT***</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<h4>⚠️Etes-vous sur de vouloir le produit<strong> N<sup>o</sup></strong> <?= $prod->getId() ?></h4>
											<a class="btn btn-danger" href="controller/DeleteProd.php?delProd=<?= $prod->getId() ?>">Delete <i class="bi bi-trash3-fill"></i></i></a>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
						</tbody>
					</table>
				</div>					
				</div>
			</div>
		</div>
		</div>
	<?php else : ?>
		<section class="container"> <!--Partie simple utilisateur -->
			<div class="table-responsive">
				<h2 style="text-align: center;" class="alert alert-primary">ALL OF PRODUCT</h2>
				<table class="table table-sm table-bordered table-hover">
					<thead>
						<tr>
							<th>Id Product </th>
							<th>Name of product</th>
							<th>Description </th>
							<th>Price of product</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($proddao->read() as $prod) : ?>
							<tr>
								<td><?= $prod->getId() ?></td>
								<td><?= $prod->getNomProduit() ?></td>
								<td><?= $prod->getDescription() ?></td>
								<td><?= $prod->getPrix() ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</section>
	<?php endif ?>
<?php endforeach ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $("#toggleFirstSection").click(function() {
      $("#firstSection").toggleClass("d-none d-block");
    });
  });

  $(document).ready(function() {
    $("#toggleSecondSection").click(function() {
      $("#secondSection").toggleClass("d-none d-block");
    });
  });
</script>	

</body>
</html>

<?php  }  ?>