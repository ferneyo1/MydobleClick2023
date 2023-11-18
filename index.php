<?php define("URL","");?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/localization/messages_es.js "></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div class="container">
		<section class="content-header">
			<h4><i class="fa fa-gavel"></i>MyDobleClick</h4>
		</section>
		<section>
		<div class="box box-warning"></div>
		<div class="statusMsg"></div>
		<div>
		<form id="formcitas" class="form" method="post"  action="index2.php">
						<div class="row">		
							<div class="col-md-3">
								<label for="labelNombre">Proyecto</label>
								<input class="form-control" type="text" name="aplicacion" id="aplicacion">
							</div>
							<div class="col-md-3">
								<label for="labelTelefono">Host</label>
								<input class="form-control" type="text" name="host" id="host">
							</div>
							<div class="col-md-3">
							<label for="labelPlaca">Base de Datos</label>
								<input class="form-control" type="text" name="based" id="based">
							</div>
							<div class="box box-warning" style="margin:10px"></div>
							<div class="col-md-12">
								<input type="hidden" name="url" value="<?php echo URL;?>" id="url">
							<button class="btn btn-success pull-right "  style="margin-left: 5px;"><i class="fa fa-eraser" id="borrar"></i> Borrar</a></button>
							<input type="submit" class="btn btn-primary pull-right saveBtn" style="margin-right: 5px;" value=guardar>
						</div>
					</div>
				</form>
		<div class="form">
		</div>
		</section>
	</div>
</body>
</html>

