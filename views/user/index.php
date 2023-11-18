<h1>Usuarios</h1>

<form method="post" action="<?php echo URL;?>user/create">
    <label>Nombre</label><input type="text" name="nombre" /><br />
    <label>Login</label><input type="text" name="usuario" /><br />
    <label>Password</label><input type="text" name="clave" /><br />
    <label>Role</label>
        <select name="role">
            <option value="default">Default</option>
            <option value="admin">Admin</option>
        </select><br />
    <label>&nbsp;</label><input type="submit" />
</form>

<hr />

<table>
<?php
    foreach($this->usuariosList as $value) {
        echo '<tr>';
        echo '<td>' . $value['id'] . '</td>';
        echo '<td>' . $value['usuario'] . '</td>';
        echo '<td>' . $value['role'] . '</td>';
        echo '<td>
                <a href="'.URL.'user/edit/'.$value['userid'].'">Edit</a> 
                <a href="'.URL.'user/delete/'.$value['userid'].'">Delete</a></td>';
        echo '</tr>';
    }
?>
</table>
