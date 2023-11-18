<?php
class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function run()
    {
		$login=$_POST['login'];
		$password=Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY);
		$sth=$this->db->prepare('SELECT usuarios.id, roles.role,usuarios.nombre,usuarios.login FROM usuarios,roles WHERE usuarios.login = :login and usuarios.password = :password and usuarios.roles_id=roles.id');
		$sth->execute(array(':login' => $login,'password'=>$password));
		
		$data=$sth->fetch();
    	$count= $sth->rowCount();
        if ($count > 0) {
            // login
            Session::init();
            Session::set('id', $data['id']);
            Session::set('role', $data['role']);
            Session::set('nombre', $data['nombre']);
            Session::set('login', $data['login']);
            Session::set('loggedIn', true);
	return 1;
			//header('location:'.URL.'index');
        } else {
	return 0;
			//header('location:'.URL.'login');
        }
        
    }
    
}
