<!DOCTYPE html>
<html lang="en">
<head>
<head>
<title>MyDobleClick</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/fontawesome.min.css">
<script src="<?php echo URL; ?>public/js/fontawesome.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/base.css">
<script type="text/javascript" src="<?php echo URL; ?>public/js/funciones.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/menu.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.1/flatly/bootstrap.min.css" integrity="sha512-NnOXwTfcNBeRenMzrDACGwxbThjRcI5H8jvM+VDKKkXA6wkAb2c0t1YgDXWmW2TNX1CUSe6Ma6HXYG2J1rBGDQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://kit.fontawesome.com/f151dcbf06.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>

	<?php Session::init(); ?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container-fluid">
	  <a class="navbar-brand" href="<?php echo URL;?>/index">MiDobleClick</a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
  
	  <div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav me-auto">
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo URL;?>/about">Nosotros</a>
		  </li>
	<!--li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Configuracion
          </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background:#2c3e50">
			<li class="nav-item">
				<a href="<?php echo URL; ?>roles" class="nav-link">roles</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo URL; ?>usuarios" class="nav-link">usuarios</a>
			</li>
		</ul>
	</li-->
		  <?php if(Session::get("role")==1):?>
		  <li class="nav-item">
		  </li>
		  <?php endif; ?>
<li class="nav-item">
	<a href="<?php echo URL; ?>categorias" class="nav-link">categorias</a>
</li>
<li class="nav-item">
	<a href="<?php echo URL; ?>productos" class="nav-link">productos</a>
</li>
<li class="nav-item">
	<a href="<?php echo URL; ?>roles" class="nav-link">roles</a>
</li>
<li class="nav-item">
	<a href="<?php echo URL; ?>usuarios" class="nav-link">usuarios</a>
</li>
</ul>
<ul class="navbar-nav mr-auto">
</ul>
<ul class="navbar-nav me-auto">
      <?php if(Session::get("loggedIn")=="true"):?>
    <li class="nav-item">
      <a href="<?php echo URL; ?>dashboard/logout" class="nav-link">logout</a>
    </li>
        <?php else: ?>
    <li class="nav-item">
              <a href="<?php echo URL; ?>login" class="nav-link">Login</a>
    </li>
    <li class="nav-item">
        <a href="<?php echo URL; ?>login" class="nav-link">Registrarse</a>
    </li>
	  <?php endif; ?>
</ul>

      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

