<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ResetsModel;


class Users extends BaseController
{

	public function __construct(){
		helper(['url', 'session', 'emai', 'upload', 'system_helper', 'database']);
	}

	public function index(){
		$data 			= [];
		$data['title']	= 'Login | linuxitos';
		$data['tab'] 	= 'login';
		helper(['form']);
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();
				$user = $model->where('email', $this->request->getVar('email'))
											->first();
				$this->setUserSession($user);
				return redirect()->to(base_url('dashboard'));
			}
		}
		//echo view('templates/header', $data);
		//echo view('login');
		//echo view('templates/footer');
		return view('login', $data);
	}

	public function login(){
		$data 			= [];
		$data['title'] 	= 'Login | linuxitos';
		$data['tab'] 	= 'ptable';
		/*echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');*/
		return view('login', $data);
	}

	public function ajxlogin(){
		helper(['form']);
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => ['validateUser' => 'Email o contraseña incorrectos.'],
				'min_length' => ['validateUser' => 'Contraseña debe ser entre 6 y 8 caracteres.'],
			];

			if (! $this->validate($rules, $errors)) {
				//$data['validation'] = $this->validator;
				$errors = $this->validator->getErrors();
				$msg = "";
				foreach ( $errors as $error) {
					$msg .= esc($error).'<br>';
				}
				$msg = array("tipo" => 'danger',
							"icon" 	=> 'fa fa-times',
							"msg" 	=> $msg);
			}else{
				$model = new UserModel();
				$user = $model->where('email', $this->request->getVar('email'))
											->first();
				$this->setUserSession($user);
				//return redirect()->to(base_url('dashboard'));
				$msg = array("tipo" => 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Registro realizado, ahora inicia sesión.');
			}
		}
		return $this->response->setJSON($msg);
	}

	private function setUserSession($user){
		$data = [
			'id_user' 	=> $user['id_user'],
			'firstname' => $user['firstname'],
			'lastname' 	=> $user['lastname'],
			'email' 	=> $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function register(){
		$data 			= [];
		$data['title'] 	= 'Registro | linuxitos';
		$data['tab'] 	= 'register';
		/*echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');*/
		return view('register', $data);
	}

	public function ajxregister(){
		helper(['form']);
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'firstname' 		=> 'required|min_length[3]|max_length[20]',
				'lastname' 			=> 'min_length[3]|max_length[20]',
				'email' 			=> 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
				'password' 			=> 'required|min_length[6]|max_length[255]',
				'password_confirm' 	=> 'matches[password]',
			];

			$messages = [
				"firstname" => [
					"required" => "El nombre es requerido."
				],
				"password" => [
					"required" => "Por favor ingrese una contraseña.",
				],
				"password_confirm" => [
					"matches" 		=> "Las contraseñas no coinciden, intenta de nuevo.",
				],
				"email" => [
					"required" 		=> "Por favor ingrese un email.",
					"valid_email" 	=> "Por favor, ingrese un email válido.",
					"is_unique" 	=> "El email ya está en uso, intenta de nuevo."
				]
			];

			if (!$this->validate($rules, $messages)) {
				//$data['validation'] = $this->validator;
				$errors = $this->validator->getErrors();
				$msg = "";
				foreach ( $errors as $error) {
					$msg .= esc($error).'<br>';
				}
				$msg = array("tipo" => 'danger',
							"icon" 	=> 'fa fa-times',
							"msg" 	=> $msg);
			}else{
				$model = new UserModel();
				$newData = [
					'firstname' 	=> $this->request->getVar('firstname'),
					'lastname' 		=> $this->request->getVar('lastname'),
					'email' 		=> $this->request->getVar('email'),
					'password' 		=> $this->request->getVar('password'),
				];
				$model->save($newData);
				/*$session = session();
				$session->setFlashdata('success', 'Registro exito. Inicia sesón.');
				return redirect()->to(base_url('/'));*/
				$msg = array("tipo" => 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Registro realizado, ahora inicia sesión.');
			}
		}
		return $this->response->setJSON($msg);
	}

	public function profile(){
		$data 			= [];
		$data['title'] 	= 'Perfil | linuxitos';
		helper(['form']);
		$model 			= new UserModel();
		$data['tab'] 	= 'profile';
		$data['user'] 	= $model->where('id_user', session()->get('id_user'))->first();
		/*echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');*/
		return view('profile', $data);
	}

	public function ajxupuser(){
		helper(['form']);
		$model 			= new UserModel();
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' 	=> 'max_length[20]',
			];

			$messages = [
				"firstname" => [
					"required" => "El nombre es requerido",
					"min_length" => "Nombre de mínimo 3 caracteres",
				],
				"password" => [
					"required" 		=> "Por favor ingrese una contraseña",
					"min_length" 	=> "Contraseña mínima de 6 caracteres.",
				],
				"password_confirm" 	=> [
					"matches" 		=> "Las contraseñas no coinciden, intenta de nuevo.",
				]
			];

			if($this->request->getPost('password') != ''){
				$rules['password'] = 'required|min_length[6]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}

			if (! $this->validate($rules, $messages)) {
				//$data['validation'] = $this->validator;
				$errors = $this->validator->getErrors();
				$msg = "";
				foreach ( $errors as $error) {
					$msg .= esc($error).'<br>';
				}
				$msg = array("tipo" => 'danger',
							"icon" 	=> 'fa fa-times',
							"msg" 	=> $msg);
			}else{
				$newData = [
					'id_user' 	=> session()->get('id_user'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' 	=> $this->request->getPost('lastname'),
				];
				if($this->request->getPost('password') != ''){
					$newData['password'] = $this->request->getPost('password');
				}
				$model->save($newData);
				$newData['email'] = session()->get('email');
				$this->setUserSession($newData);
				/*session()->setFlashdata('success', 'Actualización correcta.');
				return redirect()->to(base_url('profile'));*/
				$msg = array("tipo" => 'success',
							"icon" 	=> 'fa fa-check',
							"msg" 	=> 'Información actualizada');
			}
		}

		return $this->response->setJSON($msg);
	}

	public function logout(){
		session()->destroy();
		return redirect()->to(base_url('login'));
	}

	public function verify(){
		$data = [];
		$data['title'] = 'Validar email | linuxitos';
		helper(['form']);
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
			];

			$errors = [
				'email' => ['valid_email' => 'Email no existe, por favor verifique'],
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();
				$user = $model->where('email', $this->request->getVar('email'))
							  ->first();
				$session = session();
				if ($user) {
					$newReset = [
						'uuid' 		=> new_uuid(),
						'ip_res' 	=> $this->request->getIPAddress(),
						'email' 	=> $user['email'],
						'user_id' 	=> $user['id_user'],
					];
					$rmodel = new ResetsModel();
					$rmodel->insert($newReset);

					/**
					 * [Para que funcione el envío de email, es necesario configurar previamente el archivo app/Config/Email.php, y establecer
					 * el correo, contraseña, el método de envio, el puerto utilizado etc.,]
					 * 
					 * $protocol (si vas a usar gmail puede ser smtp, si usas un hosting propio, funciona mejor sendmail)
					 * $SMTPHost (el dominio que corresponda, por ejemplo smtp.example.com)
					 * $SMTPUser (tu correo que usarás para enviar ejemplo noreply@example.com)
					 * $SMTPPass (la contraseña del correo que usarás para enviar)
					 * $SMTPPort (el puerto que uses por smtp por default es 465)
					 * $SMTPCrypto (el tipo de encriptación ssl, tls)
					 * $mailType (sugiero html, para que puedas darle formato al correo)
					 * 
					 * @var string
					 */
					$message 	= 'linuxitos<br>Soporte Técnico<br><hr>Abrir el enclace siguiente para cambiar sus accesos <br> <a href="'.base_url('resetpassword?uuid='.$newReset['uuid']).'" target="_blank">'.base_url('resetpassword?uuid='.$newReset['uuid']).'</a><br> El link tiene una duración de 24 horas.';
					$email 		= \Config\Services::email();
					$email->setFrom('noreply@example.com', 'Reestablecer accesos');
					$email->setTo($newReset['email']);
					$email->setSubject('Reestablecer accesos');
					$email->setMessage($message);
					if ($email->send()) {
						$session->setFlashdata('success', 'Se ha enviado un enlace al correo electrónico');
					}else{
						//$session->setFlashdata('danger', $email->printDebugger(['headers']));
						$session->setFlashdata('danger', 'Error en el envío, por favor intenta más tarde.');
					}
				}else{
					$session->setFlashdata('danger', 'El email no se encontró, por favor verifique.');
				}
			}
		}
		return view('validate', $data);
	}

	public function resetpassword(){
		$session = session();
		$data = [];
		$data['title'] = 'Reestableciendo contraseña | linuxitos';
		$data['exist'] = false;
		$data['reset'] = false;
		helper(['form']);
		if ($this->request->getMethod() == 'get') {
			$model = new ResetsModel();
			$user = $model->where('uuid', $this->request->getVar('uuid'))
						  ->where('fc_res>=(CURDATE() - INTERVAL 1 DAY)')
						  ->where('edo_res', 0)
						  ->first();
			if ($user) {
				$data['uuid'] = $this->request->getVar('uuid');
				$data['id'] = $user['user_id'];
				$data['exist'] = true;
				$newReset = [
					'uuid' 		=> new_uuid(),
					'ip_res' 	=> $this->request->getIPAddress(),
					'email' 	=> $user['email'],
					'user_id' 	=> $user['user_id'],
				];
				//$session->setFlashdata('success', 'uuid:'.$user['uuid']);
				/*$rmodel = new UserModel();
				$rmodel->insert($newReset);*/
			}else{
				$session->setFlashdata('danger', $this->request->getVar('uuid'));
			}
		}
		return view('resetpassword', $data);
	}

	public function updatepassword(){
		$session = session();
		$data = [];
		$data['title'] = 'Reestableciendo contraseña | linuxitos';
		$data['reset'] = false;
		$data['exist'] = false;
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'password' 			=> 'required|min_length[6]|max_length[255]',
				'password_confirm' 	=> 'matches[password]',
			];

			$messages = [
				"password" => [
					"required" => "Por favor ingrese una contraseña",
					"min_length" => "La contraseña debe tener mínmo 6 caracteres.",
				],
				"password_confirm" => [
					"matches" 		=> "Las contraseñas no coinciden, intenta de nuevo.",
				],
			];

			if (!$this->validate($rules, $messages)) {
				$data['validation'] = $this->validator;
			}else{
				$data['reset'] = true;
				$umodel 	= new UserModel();
				$newData 	= [
					'id_user' 	=> $this->request->getVar('id'),
					'password' 	=> $this->request->getVar('password'),
				];
				$umodel->save($newData);

				$rmodel = new ResetsModel();
				$rmodel->whereIn('user_id', $this->request->getVar('id'))
						->set(['edo_res' => 1, 'fe_res'=>date("Y-m-d h:i:sa")])
						->update();
				$session->setFlashdata('success', 'Reestablecimiento de contraseña correcto.');
			}
		}
		return view('resetpassword', $data);
	}
}
