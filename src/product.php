<?php
include_once "connexion/connexion.php";
include_once "dao/UsersDAO.php";
include_once "model/Users.php";
if (!isset($_SESSION['user'])) {
	header('location:login.php');
} else {
	// instancia as classes
	$users = new Users();
	$userdao = new UsersDAO();
?>

	<!DOCTYPE html>
	<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>Manage Users</title>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light menu">
			<div class="container">
				<a class="navbar-brand" href="#">Challenge AtALOU | PRODUCT</a>
				<a class="btn  btn-info btn-sm"  href="./logout.php">Logout</a>
			</div>
		</nav><br><br>
		<h2 style="text-align: center;" class="alert alert-primary">PRODUCT | ATALOU MICROSYSTEME</h2>
		<div class="container-fluid" >
			<?php foreach ($userdao->tcheck_user() as $users) : ?>
				<?php if ($users->getRole() == 'Admin') : ?>
					<div class="modal fade" id="manage_account><?= $users->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">UPDATE USERS</h5>
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
												<label>Sex</label>
												<select name="sex" class="form-control">
													<option value="F">Feminin</option>
													<option value="M">Masculin</option>
												</select>
											</div>
										</div>
											<div class="mb-2">
												<input type="hidden" name="id" value="<?= $users->getId() ?>" />
												<button class="btn btn-primary" type="submit" name="edit">Update</button>
											</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- division du tableau et le formulaire -->
					<div class="container-fluid">
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
														<?php if($users->getStatut() == 1){ ?>
															<button class="btn btn-info btn-sm" title="Lock User" data-toggle="modal" data-target="#desac><?= $users->getId() ?>">
															<i class="bi bi-unlock-fill"></i>
															</button>
														<?php }else{ ?>	
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
																<h5 class="modal-title" id="exampleModalLabel">***DESACTIVER USER***</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form action="controller/RoleUserCrt.php" method="POST">
																	<h4>Etes-vous sur de vouloir Desactiver <strong><?= $users->getUsername() ?></strong></h4>
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
																<h5 class="modal-title" id="exampleModalLabel">***ACTIVER USER***</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form action="controller/RoleUserCrt.php" method="POST">
																	<h4>Etes-vous sur de vouloir Activer le compte de <strong><?= $users->getUsername() ?></strong></h4>
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
																<h4>Etes-vous sur de vouloir supprimer le compte de <strong><?= $users->getUsername() ?></strong></h4>
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
					</div>
<!-- .....................................................SECTION SIMPLE USER................................................... -->
				<?php else : ?>
					<br><br>
					<div class="table-responsive">
						<table class="table table-sm table-bordered table-hover">
							<thead>
								<tr>
									<th>Id</th>
									<th>Nom</th>
									<th>Prenom</th>
									<th>Username</th>
									<th>Sex</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($userdao->read_user() as $users) : ?>
									<tr>
										<td><?= $users->getId() ?></td>
										<td><?= $users->getNom() ?></td>
										<td><?= $users->getPrenom() ?></td>
										<td><?= $users->getUsername() ?></td>
										<td><?= $users->getSex() ?></td>
										<td class="text-center">
											<button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $users->getId() ?>">
												Edit Profil
											</button>
											<button class="btn  btn-info btn-sm" data-toggle="modal" data-target="#password><?= $users->getId() ?>">
												Manage Password
											</button>
										</td>
									</tr>

								<?php endforeach ?>
							</tbody>

						</table>
					</div>

				<?php endif ?>

			<?php endforeach ?>

		</div>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>

	</html>

<?php }  ?>