<?php
include_once "connexion/connexion.php";
include_once "dao/ProductDao.php";
include_once "model/Product.php";

	$prod = new Product();
	$proddao = new ProductDao();
	$prod = $proddao->read_by_id($_GET['delProd']);

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
	<title>Manage Product</title>
</head>
<body>
	<div class="container mt-4">
		<div class="row">
			<div class="col"></div>
			<div class="col-6">
				<h1 style="text-align: center" class="alert alert-info">UPDATE PRODUCT</h1>
				<form method="POST" id="updateProd" >
					<?php foreach ($prod as $item) : ?>
					<div class="form-group">
						<label for="nomProduit">Nom du produit</label>
						<input type="text" class="form-control" id="nomProduit" name="nomProduit" value="<?= $item->getNomProduit() ?>"  placeholder="Entrez le nom du produit">
					</div>
					<div class="form-group">
						<label for="prix">Prix</label>
						<input type="number" class="form-control" id="prix" name="prix" value="<?= $item->getPrix() ?>" placeholder="Entrez le prix">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description" rows="3"><?= $item->getDescription() ?></textarea>
					</div>
					<input type="hidden" class="form-control" id="id" name="id" value="<?= $item->getId() ?>" />
					<button type="submit" name="submit" class="btn btn-primary">Soumettre</button>
					<a href="home.php" class="btn btn-danger">Retour</a>
					<?php endforeach ?>
				</form>
			</div>
			<div class="col"></div>
		</div>
	</div>
</body>	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="public/js/updateProd.js"></script>
</html>

