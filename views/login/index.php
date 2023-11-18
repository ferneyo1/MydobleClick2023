   <div class="content-wrapper">
     <section class="content">
        <!-- Default box -->
		<div class="box">
       
		</div>
        <div class="box box-warning">

		</div><!-- /.box warning-->
    <div class="col-md-4 mx-auto">
   <div class="card">
      <div class="card-header">
        <h3>Login</h3>
      </div>
      <div class="card-body">
      <form action="<?php echo URL; ?>/login/run" method="post">
             <div class="form-group">
               <input type="text" name="login" id="login" class="form-control" placeholder="Ingrese login">
            </div>
            <div class="form-group">
               <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div id="msg"></div>
<!-- Mensajes de Verificación -->
            <div class="form-group">
               <button class="btn btn-primary btn-block" id="enviarLoginUsr">Enviar</button>
            </div>
         </form>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              <a href="/users/add" class="nav-link">Registrarse</a>
          </li>
          <li>
          <span>Sign in using social networks</span>
        <br/>
        <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
        <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
        <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
        </li>   
      </ul>
      </div>
</div>   
</div>
</div>
</div>
       </section><!-- /.content -->
     </div><!-- /.content-wrapper --> 