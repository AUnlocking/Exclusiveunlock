<?php
namespace App\Controllers;
use App\Models\Posts;
use App\Models\Users;

class Login extends BaseController{
	protected $helpers = [];
	protected $db;

	public function __construct(){
		helper(['url', 'session', 'emai', 'upload', 'system_helper', 'database']);
		$this->db = $db = \Config\Database::connect();
	}

	public function login(){
		$data['title'] 	= 'Login | LiNuXiToS';
		$data['tab'] 	= 'login';
		return view('login', $data);
	}

	public function loginValidate(){
		$model_user 	= new Users();
		$user=array(
			'email'		=> ($this->request->getVar('txt-email')) ? $this->request->getVar('txt-email'): "",
			'password' 	=> ($this->request->getVar('txt-password')) ? $this->request->getVar('txt-password'): "",
		);

		$info_user = $model_user->where('email', $user['email'])->first();

		if($info_user && password_verify($user['password'], $info_user->password)){
			/*$this->session->set_userdata('id_user_session',		$data['id_user']);
			$this->session->set_userdata('nom_user_session',	$data['nom_user']);
			$this->session->set_userdata('email_session',		$data['email']);**/
			$newdata = [
				'username'  => $info_user->nom_user,
				'email'     => $info_user->email,
				'logged_in' => TRUE,
			];

			$session->set($newdata);

			$msg = array("tipo" 	=> 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Inicio de sesión correcto.');
		}else{
			//$this->usuario->addLogEntry($log);
			$msg = array("tipo" 	=> 'danger',
							"icon" 	=> 'fa fa-times',
							"msg" 	=> 'Email o contraseña incorrecto.');
		}
		return $this->response->setJSON($msg);
	}

	public function singup(){
		$model_user 	= new Users();
		$user = array(
			'nom_user'	=> ($this->request->getVar('txt-nom-user')) ? trim($this->request->getVar('txt-nom-user')) : "",
			'email'		=> ($this->request->getVar('txt-email')) ? trim($this->request->getVar('txt-email')) : "",
			'password' 	=> password_hash($this->request->getVar('txt-password'), PASSWORD_DEFAULT)
		);
		$email_check 	= $model_user->where('email', $user['email'])->first();
		if(!$email_check){
			if ($model_user->insert($user)) {
				$msg = array("tipo" => 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Registro correcto, ahora inicia sesión.');
			}else{
				$msg = array("tipo" => 'danger',
							"icon" 	=> 'fa fa-times',
							"msg" 	=> 'Error con la conexión a la base de datos.');
			}
		}else{
			$msg = array("tipo" 	=> 'danger',
							"icon" 	=> 'fa fa-times',
							"msg" 	=> 'Email ya se encuentra registrado.');
		}
		return $this->response->setJSON($msg);
	}

	public function edit($id_post){
		$data['title'] 		= 'Edición | LiNuXiToS';
		$data['tab'] 		= 'edit';
		$data['id_post'] 	= ($id_post) ? $id_post : 0;

		$model_post 		= new Posts();
		$data['info_post'] 	= $model_post->get_postById($data);
		return view('edit', $data);
	}

	public function view($slug){
		$data['title'] 		= 'Vista | LiNuXiToS';
		$data['tab'] 		= 'view';
		$data['slug_post'] 	= ($slug) ? $slug : 0;

		$model_post 		= new Posts();
		$data['info_post'] 	= $model_post->get_postBySlug($data);
		return view('view', $data);
	}

	public function add(){
		$model 		= new Posts();
		$validated 	= $this->validate([
			'file' 	=> [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[file,4096]',
			],
		]);

		if ($validated) {
			$file = $this->request->getFile('file');
			$nom_img = fraseAleatoria(4).'-'.fraseAleatoria(4).'.'.$file->getClientExtension();

			$add = [
				'nom_post' 	=> $this->request->getVar('txt-nom-add') ? trim($this->request->getVar('txt-nom-add')):'',
				'desc_post' => $this->request->getVar('txt-desc-add') ? trim($this->request->getVar('txt-desc-add')):'',
				'slug_post' => $slug_post = slugify(get_words($this->request->getVar('txt-nom-add'), 5)),
				'img_post' 	=> 'files/posts/'.$nom_img,
			];

			if ($model->insert($add)) {
				$file->move('public/files/posts/', $nom_img);
				$msg = array("tipo" => 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Registro agregado correctamente.');
			}else{
				$msg = array("tipo" => 'danger',
							"icon" 	=> 'fa fa-exclamation-circle',
							"msg" 	=> 'Error con la base de datos.');
			}
		}else{
			$msg = array("tipo" => 'danger',
						"icon" 	=> 'fa fa-exclamation-circle',
						"msg" 	=> 'Tipo de archivo no válido.');
		}
		return $this->response->setJSON($msg);
	}

	public function update(){
		$model 	= new Posts();
		$id 	= $this->request->getVar('txt-id');

		$validated 	= $this->validate([
			'file' 	=> [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[file,4096]',
			],
		]);
		
		if ($validated) {
			$file = $this->request->getFile('file');
			$nom_img = fraseAleatoria(4).'-'.fraseAleatoria(4).'.'.$file->getClientExtension();
			$data = [
				'nom_post' => $this->request->getVar('txt-nom') ? trim($this->request->getVar('txt-nom')) : '',
				'desc_post'  => $this->request->getVar('txt-desc') ? trim($this->request->getVar('txt-desc')) : '',
				'slug_post'  => slugify(get_words($this->request->getVar('txt-nom'), 5)),
				'img_post' 	=> 'files/posts/'.$nom_img,
			];
			if (($save = $model->update($id, $data))) {
				$file->move('public/files/posts/', $nom_img);
				$msg = array("tipo" => 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Registro actualizado.');
			}else{
				$msg = array("tipo" => 'danger',
							"icon" 	=> 'fa fa-exclamation-circle',
							"msg" 	=> 'Error con la base de datos.');
			}
		}else{
			$msg = array("tipo" => 'danger',
						"icon" 	=> 'fa fa-exclamation-circle',
						"msg" 	=> 'Error con la base de datos.');
		}
		return $this->response->setJSON($msg);
	}
 
}
