Bienvenido <?php //echo $data['usuario'];?>

<br />
<form id="randomInsert" action="<?php echo URL;?>dashboard/xhrInsert/" method="post">
    <label>Nit</label><input type="text" name="nit" /><br>
    <label>Cliente</label><input type="text" name="cliente" /><br>
    <label>Dirección</label><input type="text" name="direccion" /><br>
    <label>Teléfono</label><input type="text" name="telefono" /><br>
    <label>Contacto1</label><input type="text" name="contacto1" /><br>
    <label>Teléfono1</label><input type="text" name="telefono1" /><br>
    <label>Email1</label><input type="text" name="email1" /><br>
    <label>Contacto2</label><input type="text" name="contacto2" /><br>
    <label>Teléfono2</label><input type="text" name="telefono2" /><br>
     <label>Email2</label><input type="text" name="email2" /><br>
    <input type="submit" />
</form>

<br />

<div id="listInserts">
    
</div>
