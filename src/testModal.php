<?php
include_once "connexion/connexion.php";
include_once "dao/UsersDAO.php";
include_once "dao/ProductDao.php";
include_once "model/Users.php";
include_once "model/Product.php";

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
						<i class="bi bi-person-x-fill"></i>
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
							<a class="btn btn-danger" href="controller/DeleteProd.php?= $prod->getId() ?>">Delete <i class="bi bi-person-x-fill"></i></a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		</tbody>
	</table>
</div>					
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

