<?php
extract($_REQUEST);
$CARPETA="$aplicacion";
$MYHOST="$host";
$MYBD="$based";
$MYUSER="root";

@mkdir("../".$CARPETA,0700);//creamos directorio principal
echo "carpeta $CARPETA creada con exito<br>";

//crear archivo htaccess
$fp=fopen(".././".$CARPETA."/.htaccess","w");
$fp=fopen(".././".$CARPETA."/.htaccess","a");
fputs($fp,'
php_flag display_errors on
php_value error_reporting 9999

RewriteEngine On
RewriteBase /'.$CARPETA.'/
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
');
fclose($fp);

//crear archivo index
$fp=fopen(".././".$CARPETA."/index.php","w");
$fp=fopen(".././".$CARPETA."/index.php","a");
fputs($fp,'<?php
require "config.php";
require "util/Auth.php";

spl_autoload_register(function ($class) {
    include "libs/" . $class . ".php";
});
$bootstrap = new Bootstrap();
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();
$bootstrap->init();
?>
');
fclose($fp);

//crear archivo config
$fp=fopen(".././".$CARPETA."/config.php","w");
$fp=fopen(".././".$CARPETA."/config.php","a");
fputs($fp,'
<?php
// Always provide a TRAILING SLASH (/) AFTER A PATH
define("URL", "http://'.$MYHOST.'/'.$CARPETA.'/");
define("LIBS", "libs/");
define("DIR","../'.$CARPETA.'/");
define("DB_TYPE", "mysql");
define("DB_HOST", "'.$MYHOST.'");
define("DB_NAME", "'.$MYBD.'");
define("DB_USER","'.$MYUSER.'");
define("DB_PASS", "");
define("HASH_GENERAL_KEY", "MixitUp200");
define("HASH_PASSWORD_KEY", "catsFLYhigh2000miles");
define("NUM_ITEMS_BY_PAGE", "10");
define("REGISTROS_INSERTADOS", "3");
?>'
);
fclose($fp);
//crear directorios de trabajo
@mkdir(".././".$CARPETA."/controllers/",0700);
@mkdir(".././".$CARPETA."/libs/",0700);
@mkdir(".././".$CARPETA."/models/",0700);
@mkdir(".././".$CARPETA."/nbprojects/",0700);
@mkdir(".././".$CARPETA."/public/",0700);
@mkdir(".././".$CARPETA."/archivos/",0700);
@mkdir(".././".$CARPETA."/dist/",0700);
@mkdir(".././".$CARPETA."/test/",0700);
@mkdir(".././".$CARPETA."/util/",0700);
@mkdir(".././".$CARPETA."/views/",0700);
@mkdir(".././".$CARPETA."/subidas/",0700);

$directorio = opendir("../".$CARPETA);
while ($archivo = readdir($directorio))
{
	if($archivo!="." or  $archivo!=".."){
	@$directorios.=$archivo."<br>";
	}
}

echo "se crearon los siguientes elementos: ".$directorios;

$directorio = opendir("controllers"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
        @copy("controllers/".$archivo,"../".$CARPETA."/controllers/".$archivo);
}
$directorio = opendir("libs"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
        @copy("libs/".$archivo,"../".$CARPETA."/libs/".$archivo);
}
$directorio = opendir("models"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
        @copy("models/".$archivo,"../".$CARPETA."/models/".$archivo);
}
$directorio = opendir("public"); //ruta actual
while ($archivo = @readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
	$fil=explode(".",$archivo);
	if(count($fil)==1){
			@mkdir(".././".$CARPETA."/public/".$archivo,0700);
			$directorio2 = @opendir("./public/".$archivo);
		while ($subarchivo = @readdir($directorio2)) //obtenemos un archivo y luego otro sucesivamente
		{
		@copy("./public/".$archivo."/".$subarchivo,"../".$CARPETA."/public/".$archivo."/".$subarchivo);
		}
	}
}
$directorio = opendir("util"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
        @copy("util/".$archivo,"../".$CARPETA."/util/".$archivo);
}
$directorio = opendir("views"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
$fil=explode(".",$archivo);
if(count($fil)==1){
	@mkdir(".././$CARPETA/views/".$archivo,0700);
	@copy("views/".$archivo."/index.php","../$CARPETA/views/".$archivo."/index.php");
	@copy("views/".$archivo."/add.php","../$CARPETA/views/".$archivo."/add.php");
	@copy("views/".$archivo."/view.php","../$CARPETA/views/".$archivo."/view.php");
	@copy("views/".$archivo."/edit.php","../$CARPETA/views/".$archivo."/edit.php");
	@copy("views/".$archivo."/copy.php","../$CARPETA/views/".$archivo."/copy.php");
	@copy("views/".$archivo."/modal.php","../$CARPETA/views/".$archivo."/modal.php");
	}
	@copy("views/".$archivo,"../$CARPETA/views/".$archivo);
}

$fp=fopen(".././".$CARPETA."/views/header.php","w");
$fp=fopen(".././".$CARPETA."/views/header.php","a");
fputs($fp,'<?php Session::init(); ?>
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container-fluid">
	  <a class="navbar-brand" href="<?php echo URL;?>/index">MiDobleClick</a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
  
	  <div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav me-auto">
		  <li class="nav-item"><a class="nav-link" href="<?php echo URL;?>/about">Nosotros</a></li>
		  <!--li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Configuracion
          </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background:#2c3e50">
			
		</ul>
	</li-->
		  <?php if(Session::get("role")==1):?>
			<li class="nav-item"><a href="<?php echo URL; ?>roles" class="nav-link">roles</a></li>
			<li class="nav-item"><a href="<?php echo URL; ?>usuarios" class="nav-link">usuarios</a></li>
			<?php endif; ?>');

fclose($fp);

$con=new PDO("mysql:host=$MYHOST;dbname=$MYBD","$MYUSER","");

$consulta0="
CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(999) NULL DEFAULT NULL,
  `role` INT(11) NOT NULL,
  `estado` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1";
$con->query($consulta0);
$consulta01="
SELECT * FROM roles WHERE role=1
";
$resultado=$con->query($consulta01);
if ($resultado->fetchColumn() <= 0) {
	$consulta00="insert into roles(nombre,descripcion,role,estado)values('Admin','Administrador del sistema',1,'activo')";
	$con->query($consulta00);	
}

$consulta1="
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `apellidos` VARCHAR(45) NULL DEFAULT NULL,
  `login` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(256) NULL DEFAULT NULL,
  `roles_id` VARCHAR(15) NULL DEFAULT NULL,
  `estado` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
  )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1";

$con->query($consulta1);
//indique los campos de la tabla usuarios de acuerdo asu tabla, en este caso los datos son usuario admin y clave admin
$consulta2="insert into usuarios(nombre,apellidos,login,password,roles_id,estado)values('Ferney','Osma','admin','36b664527d14f8b142dbcf29b5ac7ac7705ad9fa57956e3b08f03c834fd0396f','1','activo')";
$con->query($consulta2);

$sth=$con->prepare('show tables');
$sth->execute();
$data=$sth->fetchAll();
$count= $sth->rowCount();
//echo $count." tablas encontradas";
$n=0;
foreach($data as $valorn){
	$n++;
	$valor= $valorn[0];
$cols=@num_cols($valor,$con);
$nom=@trae_nombres($valor,$con,0);
$tam=@trae_tam($valor,$con,1);
$fp=fopen(".././".$CARPETA."/views/header.php","a");
fputs($fp,'
<li class="nav-item"><a href="<?php echo URL; ?>'.$valor.'" class="nav-link">'.$valor.'</a>');fputs($fp,'</li>');
fclose($fp);

//controllers
		$fp=fopen(".././".$CARPETA."/controllers/".$valor.".php","w");
		$fp=fopen(".././".$CARPETA."/controllers/".$valor.".php","a");
		$valor2=ucwords($valor);
		fputs($fp,'<?php
class '.$valor2.' extends Controller {
	public function __construct(){
		parent::__construct();
		Auth::handleLogin();
	}
	public function index(){');
	    echo trae_controlers_models($fp,$cols,$nom);
	fputs($fp,'
	$start=0;
	$this->view->page=1;
	$limite="1000000";
	$this->view->totalList=$this->model->anyList("'.$valor.'",$limite);
	$this->view->total_registros=count($this->view->totalList);
	$this->view->total_pages=ceil($this->view->total_registros/NUM_ITEMS_BY_PAGE);
	$this->view->'.$valor.'List = $this->model->'.$valor.'List($start,NUM_ITEMS_BY_PAGE);
	$this->view->render("'.$valor.'/index");
	}
	public function index_($page){');
	    echo trae_controlers_models($fp,$cols,$nom);
	fputs($fp,'
	if(isset($page)){
		$this->view->page=$page;
	}
	if(!$page){
		$start=0;
		$this->view->page=1;
	}else{
		$start=($page-1) * NUM_ITEMS_BY_PAGE;
	}
	$limite="1000000";
	$this->view->totalList=$this->model->anyList("'.$valor.'",$limite);
	$this->view->total_registros=count($this->view->totalList);
	$this->view->total_pages=ceil($this->view->total_registros/NUM_ITEMS_BY_PAGE);
	$this->view->'.$valor.'List = $this->model->'.$valor.'List($start,NUM_ITEMS_BY_PAGE);
	$this->view->render("'.$valor.'/index");
	}

	public function ultimo(){');
	echo trae_controlers_models($fp,$cols,$nom);
	fputs($fp,'
	$this->view->'.$valor.'List = $this->model->'.$valor.'ListUltimo();
	$this->view->render("'.$valor.'/index");
	}
	public function add(){');
	echo trae_controlers_models($fp,$cols,$nom);
	fputs($fp,'
	$limite=10;
	$start=0;
	$this->view->anyList=$this->model->anyList("'.$valor.'",$limite);
	$this->view->'.$valor.'List = $this->model->'.$valor.'List($start,NUM_ITEMS_BY_PAGE);
	$this->view->'.$valor.'ListUltimo = $this->model->'.$valor.'ListUltimo();
	$this->view->render("'.$valor.'/add");
	}
	public function search(){');
	echo trae_controlers_models($fp,$cols,$nom);
	fputs($fp,'
	$start=0;
	$this->view->page=1;
	$this->view->'.$valor.'List = $this->model->'.$valor.'SingleSearch($_POST["dato"],$_POST["criterio"]);
	$this->view->total_registros=count($this->view->'.$valor.'List );
	$this->view->total_pages=ceil($this->view->total_registros/NUM_ITEMS_BY_PAGE);
	$this->view->render("'.$valor.'/index");
	}
	public function view($id){');
	echo trae_controlers_models($fp,$cols,$nom);
	fputs($fp,'
	$limite=10;
	$this->view->anyList=$this->model->anyList("'.$valor.'",$limite);
	$this->view->'.$valor.'List = $this->model->'.$valor.'SingleList($id);
	$this->view->render("'.$valor.'/view");
	}
    public function edit($id){');
		echo trae_controlers_models($fp,$cols,$nom);
		fputs($fp,'
		$limite=10;
		$this->view->anyList=$this->model->anyList("'.$valor.'",$limite);
		$this->view->'.$valor.'List = $this->model->'.$valor.'SingleList($id);
		$this->view->render("'.$valor.'/edit");

	}

	public function copy($id){');
		echo trae_controlers_models($fp,$cols,$nom);
		fputs($fp,'
		$limite=1;
		$this->view->anyList=$this->model->anyList("'.$valor.'",$limite);
		$this->view->'.$valor.'List = $this->model->'.$valor.'SingleList($id);
		$this->view->render("'.$valor.'/copy");
	
		}
    public function create(){
    $data = array();');
	fputs($fp,'
	$imagen=$this->save_file(@$_FILES["imagen"]);');
	   for($i=1;$i<$cols-1;$i++){
			if($nom[$i]=="usuarios_id"){}
			else{
				 if($nom[$i]=="imagen"){
					fputs($fp,'
	$data["imagen"]=$imagen;');
					}
					else{
						fputs($fp,'
	$data["'.$nom[$i].'"] = @$_POST["'.$nom[$i].'"];');
					}
			}
		}
	fputs($fp,'
	$data["usuarios_id"] = Session::get("id");
	$data["estado"] = "activo";
	$this->model->create($data);
	$salida="";
	$data=array();
	$resultadoOrdenado = array();
	$limite=REGISTROS_INSERTADOS;
	$this->view->anyList=$this->model->anyList("'.$valor.'",$limite);
	foreach($this->view->anyList as $key => $value)
		{
	//salida de datos como una tabla
	        $salida.="<tr>";
			');
		for($i=1;$i<$cols-1;$i++){
				if($nom[$i]=="usuarios_id"){}
				else{
					 if($nom[$i]=="imagen"){
						fputs($fp,'
			$salida.="<td>".$value["imagen"]."</td>";');
						}
						else{
							fputs($fp,'
		    $salida.= "<td>".@$value["'.$nom[$i].'"]."</td>";');
						}
				}
			}
		fputs($fp,'
		    $salida.="<td>".@$this->roles(session::get("role"),$value["id"],1)."</td></tr>";');

		for($i=1;$i<$cols-1;$i++){
				if($nom[$i]=="usuarios_id"){}
			else{
				   if($nom[$i]=="imagen"){
						fputs($fp,'
    //salida de datos como un array tipo json
			//$data["imagen"]=@$value["imagen"];');
				   }
			       else{
						fputs($fp,'
		    //$data["'.$nom[$i].'"] = @value["'.$nom[$i].'"];');
				   }

			    }
			}
	fputs($fp,'
	        array_push($resultadoOrdenado, $data);');
	fputs($fp,'
		}
		echo $salida;
	    //echo json_encode($resultadoOrdenado, JSON_UNESCAPED_UNICODE );
        //header("location: " . URL . "'.$valor.'/add");
}
public function editSave($id){
	$data = array();
	$resultadoOrdenado = array();
	$data["id"] = $id;

	');
	fputs($fp,'
	$imagen=$this->save_file(@$_FILES["imagen"]);');
		for($i=1;$i<$cols-1;$i++){
			if($nom[$i]=="usuarios_id"){}
			else{
				if($nom[$i]=="imagen"){
					fputs($fp,'
    if($imagen==1){
		$data["imagen"]=$_POST["imagen2"];
	}
    else{
		$data["imagen"]=@$imagen;
	}

	');
				}
			   else{
					fputs($fp,'
	$data["'.$nom[$i].'"] = @$_POST["'.$nom[$i].'"];');
				}
			}

		}
	fputs($fp,'
	$salida="";
	$resultadoOrdenado = array();
	$limite=1000000;
	$this->view->anyList=$this->model->anyList("'.$valor.'",$limite);
		foreach($this->view->anyList as $key => $value)
			{
		//salida de datos como una tabla
		//$salida.="<tr>";
				');
			for($i=1;$i<$cols-1;$i++){
					if($nom[$i]=="usuarios_id"){}
					else{
						 if($nom[$i]=="imagen"){
							fputs($fp,'
				//$salida.="<td>".$value["imagen"]."</td>";');
							}
							else{
								fputs($fp,'
				//$salida. = "<td>".@$value["'.$nom[$i].'"]."</td>";');
							}
					}
				}
			fputs($fp,'
			    //$salida.="<td>".@$this->roles(session::get("role"),$value["id"],1)."</td></tr>";');

			for($i=1;$i<$cols-1;$i++){
					if($nom[$i]=="usuarios_id"){}
				else{
					   if($nom[$i]=="imagen"){
							fputs($fp,'
		        //salida de datos como un array tipo json
				//$data["imagen"]=@$value["imagen"];');
					   }
					   else{
							fputs($fp,'
				//$data["'.$nom[$i].'"] = @value["'.$nom[$i].'"];');
					   }

					}
				}
		fputs($fp,'
		        array_push($resultadoOrdenado, $data);');
		fputs($fp,'
			}
			//echo $salida;
			//echo json_encode($resultadoOrdenado, JSON_UNESCAPED_UNICODE );');

fputs($fp,'
    $this->model->editSave($data);
    header("location: " . URL . "'.$valor.'");
}

    public function delete($id){
    $this->model->delete($id);
    header("location: " . URL . "'.$valor.'");
    }
	public function delete_multiple(){
		$checked = array();
		$checked = $_POST["check"];
		for($i=0; $i < count($checked); $i++){
			$this->model->delete($checked[$i]);
		}
	header("location: " . URL . "'.$valor.'");
}


	public function activo($id){
        $data = array();
    	$data["id"] = $id;
        $data["estado"] = "inactivo";
        $this->model->disable($data);
    header("location: " . URL ."'.$valor.'");
    }
    public function inactivo($id){
        $data = array();
    	$data["id"] = $id;
        $data["estado"] = "activo";
        $this->model->enable($data);
    header("location: " . URL ."'.$valor.'");
    }


	public function save_file($fil){
	if( !$fil){
		  return "Ha habido un error, tienes que elegir un archivo<br/>";
		}
		else{
			$nombre = trim($fil["name"]);
			$nombre_tmp = trim($fil["tmp_name"]);
			$tipo = $fil["type"];
			$tamano = $fil["size"];
			$ext_permitidas = array("jpg","jpeg","gif","png","pdf","doc","docx","xls","xlsx");
			$partes_nombre = explode(".", $nombre);
			$extension = end( $partes_nombre );
			$ext_correcta = in_array($extension, $ext_permitidas);
			if( $ext_correcta){
			if( $fil["error"] > 0 ){
			  return "Error: " . $fil["error"] . "<br/>";
			}else{
			  //echo "Nombre: " . $nombre . "<br/>";
			  //echo "Tipo: " . $tipo . "<br/>";
			  //echo "Tamaño: " . ($tamano / 1024) . " Kb<br/>";
			  //echo "Guardado en: " . $nombre_tmp;
			  if( file_exists( "subidas/".$nombre) ){
				return "<br/>El archivo ". $nombre." ya existe: ";
			  }else{
				move_uploaded_file($nombre_tmp,"subidas/" . $nombre);
				return $nombre;
			  }
			}
		  }else{
			return 1;
		  }
		}

	}

    public function _ver($st1,$st2){
		$st3="";
		foreach($st1 as $key => $value){
			if($value["id"]==$st2){
				$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
			}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
		}
		return $st3;
	}
	public function _ver2($st1,$st2){
		foreach($st1 as $key => $value){
			if($value["id"]==$st2){
				$st3=$value["id"];
			}
		}
		return $st3;
	}
	public function _ver_mas($st1,$st2,$st3){
	foreach($st1 as $key => $value){
	if($value["id"]==$st2){
		return $value[$st3];
		}
	}
	}
	public function roles($rol,$id,$opcion){
		switch($rol){
			case 1:
				if($opcion==1){$vista="block";}else{$vista="none";}
				return "');
				fputs($fp,'
				<a href=".URL."'.$valor.'/copy/$id>
					<i class=');fputs($fp,"'fa fa-repeat'");fputs($fp,'title=Copiar></i>
				</a>&nbsp;
				<a href=".URL."'.$valor.'/view/$id>
					<i class=');fputs($fp,"'fa fa-eye'");fputs($fp,'title=Ver ></i>
				</a>&nbsp;
				<a href=".URL."'.$valor.'/edit/$id>
					<i class=');fputs($fp,"'fa fa-edit'");fputs($fp,'title=Editar ></i>
				</a>&nbsp;
				<a href=".URL."'.$valor.'/delete/$id ');fputs($fp,' id=erase>
					<i class=');fputs($fp,"'fa fa-trash'");fputs($fp,'title=Borrar ></i>
				</a>&nbsp;
				<a href=#>
					<i class=');fputs($fp,"'fa fa-plus' data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='Modal' id='a$");	fputs($fp,"id'></i>
					</a>&nbsp;");
			fputs($fp,'";
			break;
			case 2:
				case 1:
					if($opcion==1){$vista="block";}else{$vista="none";}
					return "');
					fputs($fp,'
					<a href=".URL."'.$valor.'/copy/$id>
						<i class=');fputs($fp,"'fa fa-repeat'");fputs($fp,'title=Copiar></i>
					</a>&nbsp;
					
					<a href=".URL."'.$valor.'/view/$id>
						<i class=');fputs($fp,"'fa fa-eye'");fputs($fp,'title=Ver ></i>
					</a>&nbsp;
					
					<a href=".URL."'.$valor.'/edit/$id>
						<i class=');fputs($fp,"'fa fa-edit'");fputs($fp,'title=Editar ></i>
					</a>&nbsp;
					<a href=#>
					<i class=');fputs($fp,"'fa fa-plus' data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='Modal' id='a$");	fputs($fp,"id'></i>
					</a>&nbsp;");
				fputs($fp,'";
				break;
				case 1:
					if($opcion==1){$vista="block";}else{$vista="none";}
					return "');
					fputs($fp,'
					<a href=".URL."'.$valor.'/view/$id>
						<i class=');fputs($fp,"'fa fa-eye'");fputs($fp,'title=Ver ></i>
					</a>&nbsp;
					<a href=#>
					<i class=');fputs($fp,"'fa fa-plus' data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='Modal' id='a$");	fputs($fp,"id'></i>
					</a>&nbsp;");
				fputs($fp,'";
				break;
			case 4:
			break;
			default:
				return "permisos no asignados";
				break;
		}

	}

}
?>');

fclose($fp);

//models
		$fp=fopen(".././".$CARPETA."/models/".$valor."_model.php","w");
		$fp=fopen(".././".$CARPETA."/models/".$valor."_model.php","a");

		fputs($fp,'<?php
class '.$valor2.'_Model extends Model
{

public function __construct(){
	parent::__construct();
}
public function '.$valor.'List($limite,$end){
    return $this->db->select("SELECT * FROM '.$valor.'');fputs($fp,' '); fputs($fp,' order by id desc limit $limite,$end");
}
public function anyList($tabla,$limite){
	return $this->db->select("SELECT * FROM $tabla where estado=');fputs($fp,"'activo'"); fputs($fp,'order by id desc limit $limite");
}
public function '.$valor.'ListUltimo(){
    return $this->db->select("SELECT * FROM '.$valor.' where estado=');fputs($fp,"'activo' ");fputs($fp,'order by id desc limit 1");
}
public function '.$valor.'SingleList($id){
    return $this->db->select("SELECT * FROM '.$valor.' WHERE id = :id", array(":id" => $id));
}
public function disable($data){
    $postData = array("estado" => $data["estado"],);
	$this->db->update("'.$valor.'", $postData, "id = {$data["id"]}");
}
public function enable($data){
    $postData = array("estado" => $data["estado"],);
	$this->db->update("'.$valor.'", $postData, "id = {$data["id"]}");
}
public function '.$valor.'SingleSearch($dato,$criterio){
	');
	fputs($fp,'$dato=');
	fputs($fp,"'%'");
	fputs($fp,'.$dato.');
	fputs($fp,"'%';");
	fputs($fp,'return $this->db->select("SELECT * FROM '.$valor.' WHERE  $criterio like :dato", array(":dato" => $dato));');
fputs($fp,'}

public function registrosList($tabla){
    return $this->db->select("SELECT * FROM registros where tabla=:tabla order by id DESC limit 1", array(":tabla" => $tabla) );
}

public function create($data){
    $this->db->insert("'.$valor.'", array(');
    for($i=1;$i<$cols-1;$i++){
		if($nom[$i]=="password"){
			fputs($fp,'"'.$nom[$i].'" => Hash::create("sha256",$data["password"], HASH_PASSWORD_KEY),');
			}else{
 	fputs($fp,'"'.$nom[$i].'" => $data["'.$nom[$i].'"],');
 	}
	}
	fputs($fp,'"estado" => "activo"
	));
}
public function editSave($data){
    $postData = array(');

   for($i=1;$i<$cols-1;$i++){
	if($nom[$i]=="password"){
		fputs($fp,'"'.$nom[$i].'" => Hash::create("sha256",$data["password"], HASH_PASSWORD_KEY),');
		}else{

 		fputs($fp,'"'.$nom[$i].'" => $data["'.$nom[$i].'"],');
	}
	}
	fputs($fp,');
	$this->db->update("'.$valor.'", $postData, "id = {$data["id"]}");
}
public function delete($id){
    $this->db->delete("'.$valor.'", "id = $id");
}');

for($i=1;$i<$cols-1;$i++){
		if(strpos($nom[$i],"_id")==true){
			$fr=explode("_",$nom[$i]);
fputs($fp,'
public function '.$fr[0].'List(){
	return $this->db->select("SELECT * FROM '.$fr[0].'");
}
');
fputs($fp,'
public function '.$fr[0].'SingleList($id){
	return $this->db->select("SELECT * FROM '.$fr[0].' WHERE id = :id", array(":id" => $id));
}


');
}
}


fputs($fp,'}?>');
fclose($fp);
//end models

//archivos de las vistas
		@mkdir(".././".$CARPETA."/views/".$valor,0700);

//index
		$fp=fopen(".././".$CARPETA."/views/".$valor."/index.php","w");
		$fp=fopen(".././".$CARPETA."/views/".$valor."/index.php","a");
		fputs($fp,'<?php
		$time = time();
		$fecha= date("Y-m-d (H:i:s)");
		include("modal.php");
	   ?>
<div class="content-wrapper">
	<section class="content-header">
		<h4><i class="fa fa-gavel"></i>Listado de '.$valor.'</h4>
	</section>

	<section class="content">
		<div class="box box-warning" style="padding:20px">
		    <div class="form">
		        <form class ="form" id="form '.$valor.'" method="post"  action="<?php echo URL;?>'.$valor.'/search/">
		            <div class="form-group row">
						<div class="col-sm-2">Consultar por
						</div>
		                    <div class="col-sm-3">
		                        <select class="form-control" name="criterio">');
		for($i=1;$i<$cols-1;$i++){
			if(strpos($nom[$i],"_id")==false){
				$tabla=explode("_",$nom[$i]);
				if($tabla[0]=="usuarios"){}else{
					     fputs($fp,'<option value='.$tabla[0].'>'.@ucwords($tabla[0]).'</option>');
				}
			}
		}
					 fputs($fp,'</select>
					        </div>
		                    <div class="col-sm-3">
		                        <input class="form-control" type="text" name="dato" class="search" />
	                        </div>
	                        <div class="col-sm-2">
		                        <input class="btn btn-info" id="buscar" type="submit" value="Buscar" class="search" />
	                        </div>
	                        <div class="col-sm-2">
		                        <a  href="<?php echo URL;?>'.$valor.'/add/"><button type="button" class="btn btn-success"> Agregar</button></a>
					        </div>
				    </div>
		        </form>
			</div>

			   <!--------------------------------------------contenido de la pagina principal---------------------------------------------------------------->
			<div class="table-responsive">
			    <span>Cantidad de registros: <?php echo @count($this->'.$valor.'List);?> de <?php echo $this->total_registros;?> <a id="example1" href="<?php echo URL;?>'.$valor.'/add/">Agregar</a>
			    </span>
				<form method="POST" name="multiple" action="'.$valor.'/delete_multiple"  id="multiple">
		            <table class="table table-bordered table-hover">
		                <thead>
                            <tr>
		');
		for($i=1;$i<$cols-1;$i++){
			if(strpos($nom[$i],"_id")==true){
				$tabla=explode("_",$nom[$i]);
				if($tabla[0]=="usuarios"){}else{
					   fputs($fp,'<th>'.@ucwords($tabla[0]).'</th>');
				}
			}
			else{
				        fputs($fp,'<th>'.@ucwords($nom[$i]).'</th>');
				}
		}

	                    fputs($fp,'<th>Acciones<button id="erase_multiple" name="borrar" class="btn btn-link"><i class="fa fa-trash" title="Borrar" ></i> Borrar</button></th>
	                        </tr>
			            </thead>
			            <tbody>
	<?php
    foreach($this->'.$valor.'List as $key => $value) {
		if($value["estado"]=="inactivo"){
			$bgcolor="#A9F5F2";
		}
		else{$bgcolor="#fff";}
        echo "<tr style=background-color:$bgcolor>";');
		for($i=1;$i<$cols-1;$i++){
			if(strpos($nom[$i],"_id")==true){
				$tabla=explode("_",$nom[$i]);
				if($tabla[0]=="usuarios"){}else{
					fputs($fp,'
		echo "');fputs($fp,"<td style='width:auto'>");
					fputs($fp,'".@_ver_mas($this->'.$tabla[0].'List,$value["'.$nom[$i].'"],"nombre")."</td>";');
					}
				}
				else{
					fputs($fp,'
		echo "');fputs($fp,"<td style='width:auto'>");
				    fputs($fp,'".$value["'.$nom[$i].'"]. "</td>";');
				}
		}

		fputs($fp,'
		echo "<td>";echo roles(session::get("role"),$value["id"],1,$value["estado"]);
		echo "</td></tr>";
           }
        ?>

                        </tbody>
			        </table>
					</form>
			</div>
		</div>
		<nav aria-label="...">
		<ul class="pagination">
		<?php
			if($this->page != 1) {
		?>
		<li class="page-item">
			<a class="page-link" title="una" href="<?php echo URL."'.$valor.'/index_/".($this->page-1);?>">Previous</a>
		</li>
		<?php
		}
			if($this->total_pages > 1) {
				for($i=1;$i<=$this->total_pages;$i++){
					if($this->page==$i){
		?>
		<li class="page-item active">
			<a title="dos" class="page-link" href="<?php echo URL."'.$valor.'/index_/".$i;?>"><?php echo $i;?></a>
		</li>
		<?php
			}else{
		?>
		<li class="page-item">
			<a title="dos" class="page-link" href="<?php echo URL."'.$valor.'/index_/".$i;?>"><?php echo $i;?></a>
		</li>
		<?php
				}
			}
			if($this->page!=$this->total_pages){
		?>
		<li class="page-item">
			<a class="page-link" title="una" href="<?php echo URL."'.$valor.'/index_/".($this->page+1);?>">Next</a>
		</li>
		<?php			
			}
			}	
		?>
	  </ul>
	</nav>
		
		


	</section>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        $("#erase").on("click",function(event){
            event.preventDefault();
        swal({
              title: "Estas seguro de eliminar el registro?",
              text: "Una vez eliminado no podras recuperarlo",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("El registro ha sido eliminado!", {
                  icon: "success",
                });
                window.location.href = $("#erase").attr("href");
              } else {
                swal("No fue borrado");
              }
            });
    });
	$("#erase_multiple").on("click",function(event){
		event.preventDefault();
	swal({
		  title: "Estas seguro de eliminar los registros seleccionados?",
		  text: "Una vez eliminados no podras recuperarlos",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
			swal("Los registros han sido eliminados!", {
			  icon: "success",
			});
			$("#multiple").submit();
		  } else {
			swal("No fueron borrados");
		  }
		});
});
    $("#activo").on("click",function(event){
            event.preventDefault();
        swal({
              title: "Estas seguro de Deshabilitar el registro?",
              text: "Pide al administradr para habilitarlo de nuevo",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("El registro ha sido Deshabilitado!", {
                  icon: "success",
                });
                window.location.href = $("#activo").attr("href");
              } else {
                swal("No fue Deshabilitado");
              }
            });
    });
        $("#inactivo").on("click",function(event){
            event.preventDefault();
        swal({
              title: "Estas seguro de Habilitar el registro?",
              text: "Puedes deshabilitarlo de nuevo",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("El registro ha sido Habilitado!", {
                  icon: "success",
                });
                window.location.href = $("#inactivo").attr("href");
              } else {
                swal("No fue Habilitado");
              }
            });
    });
});
    
</script>
<?php
function _ver($st1,$st2){
	$st3="";
	foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
		}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
	}
	return $st3;
}
function _ver2($st1,$st2){
	foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			$st3=$value["id"];
		}
	}
	return $st3;
}
function _ver_mas($st1,$st2,$st3){
foreach($st1 as $key => $value){
if($value["id"]==$st2){
	return $value[$st3];
	}
}
}
function roles($rol,$id,$opcion,$habil){
	switch($rol){
		case 1:
			if($opcion==1){$vista="block";}else{$vista="none";}
			return "');
			fputs($fp,'
			<a href=".URL."'.$valor.'/copy/$id>
				<i class=');fputs($fp,"'fa fa-repeat'");fputs($fp,'title=Copiar></i>
			</a>&nbsp;
			<a href=".URL."'.$valor.'/$habil/$id id=$habil>
				<i class=');fputs($fp,"'fa fa-toggle-on'");fputs($fp,'title=$habil></i>
			</a>&nbsp;
			<a href=".URL."'.$valor.'/view/$id>
				<i class=');fputs($fp,"'fa fa-eye'");fputs($fp,'title=Ver ></i>
			</a>&nbsp;
			
			<a href=".URL."'.$valor.'/edit/$id>
				<i class=');fputs($fp,"'fa fa-edit'");fputs($fp,'title=Editar ></i>
			</a>&nbsp;
			
			<a href=".URL."'.$valor.'/delete/$id ');fputs($fp,' id=erase>
					<i class=');fputs($fp,"'fa fa-trash'");fputs($fp,'title=Borrar ></i>
				</a>&nbsp;
				<a href=#>
			<i class=');fputs($fp,"'fa fa-plus' data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='Modal' id='a$");	fputs($fp,"id'>
			</i>
			</a>&nbsp;<input  type='checkbox' name='check[]'  value=");fputs($fp,'$id />');
		fputs($fp,'";
		break;
		case 2:
				if($opcion==1){$vista="block";}else{$vista="none";}
				return "');
				fputs($fp,'
				<a href=".URL."'.$valor.'/copy/$id>
					<i class=');fputs($fp,"'fa fa-repeat'");fputs($fp,'title=Copiar></i>
				</a>&nbsp;
				<a href=".URL."'.$valor.'/$habil/$id id=$habil>
				<i class=');fputs($fp,"'fa fa-toggle-on'");fputs($fp,'title=$habil></i>
				</a>&nbsp;
				<a href=".URL."'.$valor.'/view/$id>
					<i class=');fputs($fp,"'fa fa-eye'");fputs($fp,'title=Ver ></i>
				</a>&nbsp;
				
				<a href=".URL."'.$valor.'/edit/$id>
					<i class=');fputs($fp,"'fa fa-edit'");fputs($fp,'title=Editar ></i>
				</a>&nbsp;
				<a href=#>
				<i class=');fputs($fp,"'fa fa-plus' data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='Modal' id='a$");	fputs($fp,"id'></i>
				</a>&nbsp;");
			fputs($fp,'";
			break;
			case 3:
				if($opcion==1){$vista="block";}else{$vista="none";}
				return "');
				fputs($fp,'
				<a href=".URL."'.$valor.'/view/$id>
					<i class=');fputs($fp,"'fa fa-eye'");fputs($fp,'title=Ver ></i>
				</a>&nbsp;
				<a href=#>
				<i class=');fputs($fp,"'fa fa-plus' data-bs-toggle='modal' data-bs-target='#staticBackdrop' title='Modal' id='a$");	fputs($fp,"id'></i>
				</a>&nbsp;");
			fputs($fp,'";
			break;
		case 4:
		break;
		default:
			return "permisos no asignados";
			break;
	}

}

?>');
		fclose($fp);
//end index
//add
		$fp=fopen(".././".$CARPETA."/views/".$valor."/add.php","w");
		$fp=fopen(".././".$CARPETA."/views/".$valor."/add.php","a");
		fputs($fp,'<?php
		date_default_timezone_set("America/Bogota");
		$fecha= date("Y-m-d");
		$time= date("H:i:s");
	    ?>
<div class="content-wrapper">
	<section class="content-header">
		<h4><i class="fa fa-gavel"></i>Listado de '.$valor.'</h4>
	</section>
	<section class="content">
		    <div class="box box-warning" style="padding:20px">
		        <div class="form">
		            <div class="statusMsg"></div>
		                <form id="form'.$valor.'" class="form" method="post"  enctype="multipart/form-data">
		                    <div class="form-group row">
		');

		for($i=1;$i<$cols-1;$i++){

				if(strpos($nom[$i],"_id")==true){
					$tabla=explode("_",$nom[$i]);
					if($tabla[0]=="usuarios"){}else{
					fputs($fp,'
				 	            <div class="col-xs-12 col-sm-6 col-lg-3">
						            <label for="label'.@ucwords($tabla[0]).'">'.@ucwords($tabla[0]).'</label>
						                <select class="form-control" name="'.@$nom[$i].'">');
											$combi=trae_lista($tabla[0],$con,1);
											fputs($fp,'
											<option value="" selected>Seleccione una Opcion</option>
											<?php
											foreach($this->'.$tabla[0].'List as $valor) {
						               echo "<option value=" . $valor["id"] . ">".$valor["nombre"]."</option>";
											}?>');

										fputs($fp,'
						                </select></div>');

				}
					}
				else{
					if($tam[$i]=="date" || $tam[$i]=="timestamp" || $tam[$i]=="datetime"){
						$marca=explode("_",$nom[$i]);
						fputs($fp,'
						        <div class="col-xs-12 col-sm-6 col-lg-3">
					                <label for="label'.@ucwords($marca[0].' '.$marca[1]).'">'.@ucwords($marca[0].' '.$marca[1]).'</label>
						                <input class="form-control" type="date" name="'.@$nom[$i].'"></div>');
						}
						else{
							if($tam[$i]=="date" || $tam[$i]=="timestamp"  || $tam[$i]=="datetime"){
								fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
						            <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							            <input class="form-control" type="date" name="'.@$nom[$i].'"></div>');
							}
							else{
								if(strpos($tam[$i],"999")==true){
									fputs($fp,'
								<div class="col-xs-12 col-sm-12 col-lg-12">
						            <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							            <textarea class="form-control" name="'.@$nom[$i].'" cols="120" rows="2"></textarea></div>');
							}
							else{
								if(strpos($tam[$i],"(1)")==true){
									fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio"  name="'.@$nom[$i].'" id="'.@$nom[$i].'0" value="0">
								  <label class="form-check-label" for="label'.@ucwords($nom[$i]).'">0</label>
								 <input class="form-check-input" type="radio"  name="'.@$nom[$i].'" id="'.@$nom[$i].'1" value="1" checked>
								<label class="form-check-label" for="label'.@ucwords($nom[$i]).'">1</label>
							  </div></div>');
								}
								else{

								if($nom[$i]=="password"){
									$tipo="password";
									fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
						             <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							            <input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'"></div>');
									
									}
									else{
										if($nom[$i]=="imagen"){
											$tipo="file";
											fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
						            <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
										<input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'"></div>');
								}else{
									$tipo="text";
									fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
						             <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							            <input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'"></div>');
									}
								}
								}
							}
							}
							}
				    }
			}


			fputs($fp,'
			<div class="col-xs-12 col-sm-12 col-lg-12" style="margin-top:7px">
			  <input type="hidden" name="url" value="<?php echo URL;?>" id="url">
              <button class="btn btn-success pull-right "  style="margin-right: 5px;"><i class="fa fa-eraser" id="borrar"></i> Borrar</a></button>
              <input type="submit" class="btn btn-primary pull-right saveBtn" style="margin-right: 5px;" value=guardar>
		    </div>
		 </div>
		</form>
	   </div>
	   <!--------------------------------------------contenido de la pagina principal---------------------------------------------------------------->
	   <div class="table-responsive">
	   <span class="ultimosMsg" style="display:none"><h4>Ultimos <?php echo REGISTROS_INSERTADOS;?> Registros Insertados</h4></span>
	   <table class="table table-bordered table-hover">
		<thead>
		  <tr>
		');
		for($i=1;$i<$cols-1;$i++){
			if(strpos($nom[$i],"_id")==true){
				$tabla=explode("_",$nom[$i]);
				if($tabla[0]=="usuarios"){}else{
					fputs($fp,'<th>'.@ucwords($tabla[0]).'</th>');
				}
			}
			else{
				fputs($fp,'<th>'.@ucwords($nom[$i]).'</th>');
				}
		}

	fputs($fp,'<th>Acciones</th></tr></thead>
	    <tbody id="tbody">
		</tbody>
		</table>
	  </div>
  </div>
</section>
</div>
<link href="https://cdn.jsdelivr.net/gh/xxjapp/xdialog@3/xdialog.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/gh/xxjapp/xdialog@3/xdialog.min.js"></script>
<script>
    $(document).ready(function(){
        $("#erase").on("click",function(e){
             xdialog.confirm("Seguro que desea Eliminar el Registro?", function() {
                // do work here if ok/yes selected...
                console.info("Done!");
            }, {
                style: "width:420px;font-size:0.8rem;",
                buttons: {
                  ok: "Si Eliminar",
                  cancel: "No Eliminar"
            },
                oncancel: function() {
                  console.warn("Cancelled!");
                  e.stopImmediatePropagation();
                  e.preventDefault();
            }
            });
        })
    });
</script>
<?php
function _ver($st1,$st2){
	$st3="";
	foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
		}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
	}
	return $st3;
}
function _ver2($st1,$st2){
	foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			$st3=$value["id"];
		}
	}
	return $st3;
}
function _ver_mas($st1,$st2,$st3){
foreach($st1 as $key => $value){
if($value["id"]==$st2){
	return $value[$st3];
	}
}
}


?>');

fputs($fp,'
			<script>
			$(document).ready(function(e)
			{
				var url=$("#url").val();
				$(".statusMsg").attr("color","red");
				$("#form'.$valor.'").on("submit", function(e) {
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: url+"'.$valor.'/create",
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function() {
							$(".saveBtn").attr("disabled", "disabled");
							$("#form'.$valor.'").css("opacity", ".5");
							$(".statusMsg").html("enviando");
						},
						success: function(response) {
							$("#tbody").html(response);
							$(".statusMsg").html("Datos enviados Correctamente");
							$(".saveBtn").removeAttr("disabled");
							$(".ultimosMsg").css("display","block");
							$("#form'.$valor.'").css("opacity", "");
							$("#form'.$valor.'")[0].reset();
						}
					});
				});
				/*
				$("#vehiculos_id").change(function(){
					var dato=$(this).val();
					var data="dato="+dato+"&criterio=id";
					$.ajax({
						type: "POST",
						url: url+"vehiculos/searchGrupo",
						data: data,
						beforeSend: function() {
						},
						success: function(response) {
							var datos=JSON.parse(response);
							//var datos = JSON.parse[response];
							for (var item of datos) {
								$("#marca").val(item.nombre);
								$("#linea").val(item.linea);
								$("#modelo").val(item.modelo);
								$("#kilometros").val(item.kilometros);

                             }


						}
					});

				});
				*/
				
			});
		</script>
			');

		fclose($fp);
//end add
//edit
		$fp=fopen(".././".$CARPETA."/views/".$valor."/edit.php","w");
		$fp=fopen(".././".$CARPETA."/views/".$valor."/edit.php","a");
		fputs($fp,'<?php
		foreach($this->'.$valor.'List as $key =>$value){
          $id=$value["id"];
		}
		date_default_timezone_set("America/Bogota");
		$fecha= date("Y-m-d");
		$time= date("H:i:s");
	?>
<div class="content-wrapper" >
	  <section class="content-header">
		<h4><i class="fa fa-gavel"></i>Pagina de '.$valor.' No <?php echo $id; ?></h4>
	  </section>
  <section class="content">
   <div class="box box-warning" style="padding:20px">
     <div class="form">
		<form method="post" action="<?php echo URL;?>'.$valor.'/editSave/<?php echo $id; ?>" enctype="multipart/form-data">
		<div class="form-group row">
		<?php
		foreach($this->'.$valor.'List as $key =>$value){
		?>
		');

		for($i=1;$i<$cols-1;$i++){

			if(strpos($nom[$i],"_id")==true){
				$tabla=explode("_",$nom[$i]);
				if($tabla[0]=="usuarios"){}else{
				fputs($fp,'
							 <div class="col-xs-12 col-sm-6 col-lg-3">
								<label for="label'.@ucwords($tabla[0]).'">'.@ucwords($tabla[0]).'</label>
									<select class="form-control" name="'.@$nom[$i].'">');
									fputs($fp,'<?php
									echo @_ver($this->'.$tabla[0].'List,$value["'.$tabla[0].'_id"]);

								?>');

									fputs($fp,'
									</select></div>');

			}
				}
			else{
				if($tam[$i]=="date" || $tam[$i]=="timestamp" || $tam[$i]=="datetime"){
					$marca=explode("_",$nom[$i]);
					fputs($fp,'
							<div class="col-xs-12 col-sm-6 col-lg-3">
								<label for="label'.@ucwords($marca[0].' '.$marca[1]).'">'.@ucwords($marca[0].' '.$marca[1]).'</label>
									<input class="form-control" type="date" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>"></div>');
					}
					else{
						if($tam[$i]=="date" || $tam[$i]=="timestamp"  || $tam[$i]=="datetime"){
							fputs($fp,'
							<div class="col-xs-12 col-sm-6 col-lg-3">
								<label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
									<input class="form-control" type="date" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>"></div>');
						}
						else{
							if(strpos($tam[$i],"999")==true){
								fputs($fp,'
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
									<textarea class="form-control" name="'.@$nom[$i].'" cols="120" rows="2"><?php echo $value["'.$nom[$i].'"];?></textarea></div>');
						}
						else{
							if(strpos($tam[$i],"(1)")==true){
								fputs($fp,'
							<div class="col-xs-12 col-sm-6 col-lg-3">
							  <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
								<div class="form-check form-check-inline">
								        <input class="form-check-input" type="radio"  name="'.@$nom[$i].'" id="'.@$nom[$i].'0" value="0">
								    <label class="form-check-label" for="label'.@ucwords($nom[$i]).'">0</label>
								        <input class="form-check-input" type="radio"  name="'.@$nom[$i].'" id="'.@$nom[$i].'1" value="1" checked>
								    <label class="form-check-label" for="label'.@ucwords($nom[$i]).'">1</label>
							    </div>
							</div>');
							}
							else{

							if($nom[$i]=="password"){
								$tipo="password";
								fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
						             <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							            <input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'"></div>');
									
									}
								
								else{
									if($nom[$i]=="imagen"){
										$tipo="file";
										fputs($fp,'
							<div class="col-xs-12 col-sm-6 col-lg-3">
								<label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
									<input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>">
									<input type=hidden name="'.@$nom[$i].'2" value="<?php echo $value["'.$nom[$i].'"];?>">
									</div>');
							}else{
								$tipo="text";
								fputs($fp,'
							<div class="col-xs-12 col-sm-6 col-lg-3">
								 <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
									<input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>"></div>');
								}
							}
							}
						}
						}
						}
				}
		}
		fputs($fp,'
		<?php }
		?>
		    <div class="col-xs-12 col-sm-12 col-lg-12" style="margin-top:7px">
			  <input type="hidden" name="url" value="<?php echo URL;?>" id="url">
              <button class="btn btn-success pull-right "  style="margin-right: 5px;"><i class="fa fa-eraser" id="borrar"></i> Borrar</a></button>
              <input type="submit" class="btn btn-primary pull-right saveBtn" style="margin-right: 5px;" value=Actualizar>
		    </div>
		 </div>
		</form>
	   </div>
	 </div>
	</section>
</div>
		<?php
		function _ver($st1,$st2){
			$st3="";
			foreach($st1 as $key => $value){
				if($value["id"]==$st2){
					$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
				}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
			}
			return $st3;
		}
		function _ver2($st1,$st2){
			foreach($st1 as $key => $value){
				if($value["id"]==$st2){
					$st3=$value["id"];
				}
			}
			return $st3;
		}
		function _ver_mas($st1,$st2,$st3){
		foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			return $value[$st3];
			}
		}
		}

		?>');

		fclose($fp);

//end edit

//copy

$fp=fopen(".././".$CARPETA."/views/".$valor."/copy.php","w");
$fp=fopen(".././".$CARPETA."/views/".$valor."/copy.php","a");
fputs($fp,'<?php
foreach($this->'.$valor.'List as $key =>$value){
  $id=$value["id"];
}
date_default_timezone_set("America/Bogota");
$fecha= date("Y-m-d");
$time= date("H:i:s");
?>
<div class="content-wrapper" >
<section class="content-header">
<h4><i class="fa fa-gavel"></i>Pagina de '.$valor.' No <?php echo $id; ?></h4>
</section>
<section class="content">
<div class="box box-warning" style="padding:20px">
<div class="form">
<form id="form'.$valor.'" class="form" method="post"  enctype="multipart/form-data">
<div class="form-group row">
<?php
foreach($this->'.$valor.'List as $key =>$value){
?>
');

for($i=1;$i<$cols-1;$i++){

	if(strpos($nom[$i],"_id")==true){
		$tabla=explode("_",$nom[$i]);
		if($tabla[0]=="usuarios"){}else{
		fputs($fp,'
					 <div class="col-xs-12 col-sm-6 col-lg-3">
						<label for="label'.@ucwords($tabla[0]).'">'.@ucwords($tabla[0]).'</label>
							<select class="form-control" name="'.@$nom[$i].'">');
							fputs($fp,'<?php
							echo @_ver($this->'.$tabla[0].'List,$value["'.$tabla[0].'_id"]);

						?>');

							fputs($fp,'
							</select></div>');

	}
		}
	else{
		if($tam[$i]=="date" || $tam[$i]=="timestamp" || $tam[$i]=="datetime"){
			$marca=explode("_",$nom[$i]);
			fputs($fp,'
					<div class="col-xs-12 col-sm-6 col-lg-3">
						<label for="label'.@ucwords($marca[0].' '.$marca[1]).'">'.@ucwords($marca[0].' '.$marca[1]).'</label>
							<input class="form-control" type="date" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>"></div>');
			}
			else{
				if($tam[$i]=="date" || $tam[$i]=="timestamp"  || $tam[$i]=="datetime"){
					fputs($fp,'
					<div class="col-xs-12 col-sm-6 col-lg-3">
						<label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							<input class="form-control" type="date" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>"></div>');
				}
				else{
					if(strpos($tam[$i],"999")==true){
						fputs($fp,'
					<div class="col-xs-12 col-sm-12 col-lg-12">
						<label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							<textarea class="form-control" name="'.@$nom[$i].'" cols="120" rows="2"><?php echo $value["'.$nom[$i].'"];?></textarea></div>');
				}
				else{
					if(strpos($tam[$i],"(1)")==true){
						fputs($fp,'
					<div class="col-xs-12 col-sm-6 col-lg-3">
					  <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
						<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio"  name="'.@$nom[$i].'" id="'.@$nom[$i].'0" value="0">
							<label class="form-check-label" for="label'.@ucwords($nom[$i]).'">0</label>
								<input class="form-check-input" type="radio"  name="'.@$nom[$i].'" id="'.@$nom[$i].'1" value="1" checked>
							<label class="form-check-label" for="label'.@ucwords($nom[$i]).'">1</label>
						</div>
					</div>');
					}
					else{

					if($nom[$i]=="password"){
						$tipo="password";
						fputs($fp,'
								<div class="col-xs-12 col-sm-6 col-lg-3">
						             <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							            <input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'"></div>');
									
						
						}
						else{
							if($nom[$i]=="imagen"){
								$tipo="file";
								fputs($fp,'
					<div class="col-xs-12 col-sm-6 col-lg-3">
						<label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							<input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>">
							<input type=hidden name="'.@$nom[$i].'2" value="<?php echo $value["'.$nom[$i].'"];?>">
							</div>');
					}else{
						$tipo="text";
						fputs($fp,'
					<div class="col-xs-12 col-sm-6 col-lg-3">
						 <label for="label'.@ucwords($nom[$i]).'">'.@ucwords($nom[$i]).'</label>
							<input class="form-control" type="'.$tipo.'" name="'.@$nom[$i].'" value="<?php echo $value["'.$nom[$i].'"];?>"></div>');
						}
					}
					}
				}
				}
				}
		}
}
fputs($fp,'
<?php }
?>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="margin-top:7px">
	  <input type="hidden" name="url" value="<?php echo URL;?>" id="url">
	  <button class="btn btn-success pull-right "  style="margin-right: 5px;"><i class="fa fa-eraser" id="borrar"></i> Borrar</a></button>
	  <input type="submit" class="btn btn-primary pull-right saveBtn" style="margin-right: 5px;" value=Guardar>
	</div>
 </div>
</form>
</div>

<!--------------------------------------------contenido de la pagina principal---------------------------------------------------------------->
	   <div class="table-responsive">
	   <table class="table table-bordered table-hover">
		<thead>
		  <tr>
		');
		for($i=1;$i<$cols-1;$i++){
			if(strpos($nom[$i],"_id")==true){
				$tabla=explode("_",$nom[$i]);
				if($tabla[0]=="usuarios"){}else{
					fputs($fp,'<th>'.@ucwords($tabla[0]).'</th>');
				}
			}
			else{
				fputs($fp,'<th>'.@ucwords($nom[$i]).'</th>');
				}
		}

	fputs($fp,'<th>Acciones</th></tr></thead>
	    <tbody id="tbody">

		</tbody>
		</table>
	  </div>
  </div>
</section>
</div>
<?php
function _ver($st1,$st2){
	$st3="";
	foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
		}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
	}
	return $st3;
}
function _ver2($st1,$st2){
	foreach($st1 as $key => $value){
		if($value["id"]==$st2){
			$st3=$value["id"];
		}
	}
	return $st3;
}
function _ver_mas($st1,$st2,$st3){
foreach($st1 as $key => $value){
if($value["id"]==$st2){
	return $value[$st3];
	}
}
}


?>');

fputs($fp,'
			<script>
			$(document).ready(function(e)
			{
				var url=$("#url").val();
				$(".statusMsg").attr("color","red");
				$("#form'.$valor.'").on("submit", function(e) {
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: url+"'.$valor.'/create",
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function() {
							$(".saveBtn").attr("disabled", "disabled");
							$("#form'.$valor.'").css("opacity", ".5");
							$(".statusMsg").html("enviando");
						},
						success: function(response) {
							$("#tbody").html(response);
							$(".statusMsg").html("Datos enviados Correctamente");
							$(".saveBtn").removeAttr("disabled");
							$("#form'.$valor.'").css("opacity", "");
							$("#form'.$valor.'")[0].reset();
						}
					});
				});
				/*
				$("#vehiculos_id").change(function(){
					var dato=$(this).val();
					var data="dato="+dato+"&criterio=id";
					$.ajax({
						type: "POST",
						url: url+"vehiculos/searchGrupo",
						data: data,
						beforeSend: function() {
						},
						success: function(response) {
							var datos=JSON.parse(response);
							//var datos = JSON.parse[response];
							for (var item of datos) {
								$("#marca").val(item.nombre);
								$("#linea").val(item.linea);
								$("#modelo").val(item.modelo);
								$("#kilometros").val(item.kilometros);

                             }


						}
					});

				});
				*/
			});
		</script>
			');

fclose($fp);
//end copy


//view
		$fp=fopen(".././".$CARPETA."/views/".$valor."/view.php","w");
		$fp=fopen(".././".$CARPETA."/views/".$valor."/view.php","a");
		fputs($fp,'<?php
	date_default_timezone_set("America/Bogota");
	$fecha= date("Y-m-d");
	$time= date("H:i:s");
?>
<div class="content-wrapper">
    <section class="content-header">
          <h4>
            <i class="fa fa-gavel"></i>Página de '.$valor.'
          </h4>
    </section>
	<section class="content">
	    <div class="box box-warning" style="padding:20px">
	    

		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
			<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Content1</button>
			</li>
			<li class="nav-item" role="presentation">
			<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Content2</button>
			</li>
			<li class="nav-item" role="presentation">
			<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Content3</button>
			</li>
		</ul>
	  <div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">');
			
		fputs($fp,'<?php
	
							foreach($this->'.$valor.'List as $key => $value)
							{
								?>
								<section class="py-5">
									<div class="container px-4 px-lg-5 my-5">
										<div class="row gx-4 gx-lg-5 align-items-center">
											<div class="col-md-6">
												<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
													<div class="carousel-inner">
														<div class="carousel-item active">
														<?php
														if(isset($value["imagen"])){
															$ext=explode(".",$value["imagen"]);
															$extension = end($ext);
															$ext_permitidas = array("pdf","doc","docx","xls","xlsx","ppt","pptx");
															$ext_correcta = in_array($extension, $ext_permitidas);
															if( $ext_correcta){?>
																<embed src="../../subidas/<?php echo $value["imagen"];?>" type="application/pdf" width="100%" height="600px" />
																<a class="d-block w-100" href="../../subidas/<?php echo $value["imagen"];?>" target="_blank">descargar</a>
															<?php
															}
															else{
															?>
																<img class="d-block w-100" src="../../subidas/<?php echo $value["imagen"];?>" alt="First slide">
															<?php
																}
															}
														?>
														</div>
														<?php
													  //while
														?>
														<div class="carousel-item ">
															<p>prueba</p>
															<?php
															if(isset($value["imagen"])){
																?>
															<img class="card-img-top mb-5 mb-md-0" src="<?php//imagenes?>" alt="..." />
															<?php
															}
															?>
														</div>
													</div>  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
															<span class="carousel-control-prev-icon" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
														</a>
														<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
															<span class="carousel-control-next-icon" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
														</a>
													</div>
													</div>
											<div class="col-md-6">
												<div class="small mb-1">xxxxxx</div>
												<h1 class="display-5 fw-bolder"><?php echo $value["nombre"];?></h1>
												<div class="fs-5 mb-5">
												<div class="panel panel-default" id="muestra">
													<ul class="list-group" style="list-style:none">'
														
												);
	
												for($i=1;$i<$cols-1;$i++){
													if(strpos($nom[$i],"_id")==true){
														$tabla=explode("_",$nom[$i]);
														if($tabla[0]=="usuarios"){}
															else{
																if($tabla[0]!="imagen"){
															fputs($fp,'
											<li  class="list-group-item"><label>'.$tabla[0].': </label><?php echo @_ver_mas($this->'.$tabla[0].'List,$value["'.$nom[$i].'"],"nombre");?></li>');
															}
															}
													}
													else{
														if($nom[$i]=="nombre" || $nom[$i]=="imagen"){}
														else{
														fputs($fp,'
											<li  class="list-group-item"><label>'.$nom[$i].': </label>&nbsp;<?php echo $value["'.$nom[$i].'"];?></li>');
														}
													}
						
												}
												fputs($fp,'
													</ul>
												</div>
												</div>
												<div class="d-flex">
													<input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
													<button class="btn btn-outline-dark flex-shrink-0" type="button">
														<i class="bi-cart-fill me-1"></i>
														Add to cart
													</button>
												</div>
											
										</div>
									</div>
								</section>
		
	</div>
	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	<div class="row">
		<div class="col-md-3" style="margin-bottom:10px;margin-top:50px">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title d-flex justify-content-between align-items-left" >
							titulo
						</h3>
					</div>
					<div class="card-body">
						descripcion
					</div>
					<form action="" method="post">
						<button type="submit"  class="btn btn-success btn-block btn-sm enviar">Ingresar</button>
					</form>
				</div>
		</div>
	</div>
	</div>
	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	<div class="row">
		<div class="col-md-3" style="margin-bottom:10px;margin-top:50px">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title d-flex justify-content-between align-items-left" >
						titulo
					</h3>
				</div>
				<div class="card-body">
					descripcion
				</div>
				<form action="" method="post">
					<button type="submit"  class="btn btn-success btn-block btn-sm enviar">Ingresar</button>
				</form>
			</div>
		</div>
	</div>
	</div>
	</section>
</div>


  ');
fputs($fp,'<?php }
					function _ver($st1,$st2){
						$st3="";
						foreach($st1 as $key => $value){
							if($value["id"]==$st2){
								$st3.="<option value=".$value["id"]." selected>".$value["nombre"]."</option>";
							}$st3.="<option value=".$value["id"].">".$value["nombre"]."</option>";
						}
						return $st3;
					}
					function _ver2($st1,$st2){
						foreach($st1 as $key => $value){
							if($value["id"]==$st2){
								$st3=$value["id"];
							}
						}
						return $st3;
					}
					function _ver_mas($st1,$st2,$st3){
					foreach($st1 as $key => $value){
					if($value["id"]==$st2){
						return $value[$st3];
						}
					}
					}



				?>
				<script>
				$(document).ready(function() {
				  var $tabButtonItem = $("#tab-button li"),
					  $tabSelect = $("#tab-select"),
					  $tabContents = $(".tab-contents"),
					  activeClass = "is-active";

				  $tabButtonItem.first().addClass(activeClass);
				  $tabContents.not(":first").hide();

				  $tabButtonItem.find("a").on("click", function(e) {
					var target = $(this).attr("href");

					$tabButtonItem.removeClass(activeClass);
					$(this).parent().addClass(activeClass);
					$tabSelect.val(target);
					$tabContents.hide();
					$(target).show();
					e.preventDefault();
				  });

				  $tabSelect.on("change", function() {
					var target = $(this).val(),
						targetSelectNum = $(this).prop("selectedIndex");

					$tabButtonItem.removeClass(activeClass);
					$tabButtonItem.eq(targetSelectNum).addClass(activeClass);
					$tabContents.hide();
					$(target).show();
				  });

			var url=$("#url").val();
			 $(".statusMsg").attr("color","red");
			  $("#formo'.$valor.'").on("submit", function(e) {
				  e.preventDefault();
				  $.ajax({
					  type: "POST",
					  url: url+"ordenestrabajos/create",
					  data: new FormData(this),
					  contentType: false,
					  cache: false,
					  processData: false,
					  beforeSend: function() {
						  $(".saveBtn").attr("disabled", "disabled");
						  $("#formo'.$valor.'").css("opacity", ".5");
						  $(".statusMsg").html("enviando");
					  },
					  success: function(response) {
						  $(".statusMsg").html("Datos enviados Correctamente");
						  $(".saveBtn").removeAttr("disabled");
						  $("#formo'.$valor.'").css("opacity", "");
						  $("#formo'.$valor.'")[0].reset();
					  }
				  });

				});

				/*
				$("#vehiculos_id").change(function(){
					var dato=$(this).val();
					var data="dato="+dato+"&criterio=id";
					$.ajax({
						type: "POST",
						url: url+"vehiculos/searchGrupo",
						data: data,
						beforeSend: function() {
						},
						success: function(response) {
							var datos=JSON.parse(response);
							//var datos = JSON.parse[response];
							for (var item of datos) {
								$("#marca").val(item.nombre);
								$("#linea").val(item.linea);
								$("#modelo").val(item.modelo);
								$("#kilometros").val(item.kilometros);

                             }


						}
					});

				});
                */


				});

				</script>



				');

		fclose($fp);

//end view

//modal
$fp=fopen(".././".$CARPETA."/views/".$valor."/modal.php","w");
$fp=fopen(".././".$CARPETA."/views/".$valor."/modal.php","a");
fputs($fp,'<?php
	date_default_timezone_set("America/Bogota");
	$fecha= date("Y-m-d");
	$time= date("H:i:s");
?>
			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Understood</button>
						</div>
					</div>
				</div>
			</div>

');
fclose($fp);
//end modal
$lista="";
@$lista.=$valor."<br>";
}
	echo "<br>se crearon los controladores los modelos y las vistas de los siguientes elementos:<br>" .$lista;

$fp=fopen(".././".$CARPETA."/views/header.php","a");
fputs($fp,'
</ul>
<ul class="navbar-nav mr-auto">
</ul>
<span style="color:#fff"><?php echo Session::get("nombre");?></span>
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
    			

');

fclose($fp);


//footer
$fp=fopen(".././".$CARPETA."/views/footer.php","w");
$fp=fopen(".././".$CARPETA."/views/footer.php","a");
fputs($fp,'<div id="footer">
    (R) Desarrollado por Ferney Osma Mejia cel  3137975944 ferneyo@gmail.com
</div>
</body>
</html>
');
fclose($fp);
function num_cols($valor,$con){
	$sth=$con->prepare('select * from '.$valor);
	$sth->execute();
	$cols= $sth->columnCount();
	return $cols;
	}
function trae_nombres($valor,$con,$col){
	$dato=array();
	$sth=$con->prepare('SHOW FIELDS from '.$valor);
	$sth->execute();
	$data=$sth->fetchAll();
	foreach ($data as $valor){
		$dato[]= $valor[$col];
		}
		return $dato;
	}
function trae_tam($valor,$con,$col){
	$dato=array();
	$sth=$con->prepare('SHOW FIELDS from '.$valor);
	$sth->execute();
	$data=$sth->fetchAll();
	foreach ($data as $valor){
		$dato[]= $valor[$col];
		}
		return $dato;
	}
function trae_lista($tabla,$con,$col){
	$dato=array();
	$sth=$con->prepare('select distinct id, nombre from '.$tabla);
	$sth->execute();
	$data=$sth->fetchAll();
	foreach ($data as $valor){
		$dato[]= $valor[$col];
		//echo $dato[1];
		}

	}
function trae_controlers_models($fp,$cols,$nom){
	$salida="";
	for($i=1;$i<$cols-1;$i++){
		if(strpos($nom[$i],"_id")==true){
			$fr=explode("_",$nom[$i]);
				@$salida.= fputs($fp,'$this->view->'.$fr[0].'List = $this->model->'.$fr[0].'List();');
		}


	}
	return @$salida;
}
echo "<h2><a href='../../".$CARPETA."'>Ir al proyecto</a></h2>";
?>