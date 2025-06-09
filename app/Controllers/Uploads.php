<?php
namespace App\Controllers;
use App\Models\Posts;

class Uploads extends BaseController{
	protected $helpers = [];
	protected $db;

	public function __construct(){
		helper(['url', 'session', 'email', 'upload', 'system_helper', 'database']);
		$this->db 			= $db = \Config\Database::connect();
	}

	public function index(){
		$data['title'] 	= 'Upload Images | LiNuXiToS';
		$data['tab'] 	= 'images';
		return view('images', $data);
	}

	public function store(){
		helper(['form', 'url']);
		$db 		= \Config\Database::connect();
		$builder 	= $db->table('files');
		$validated 	= $this->validate([
			'file' => [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[file,4096]',
			],
		]);
		$msg = 'Error al subir el archivo.';
		if ($validated) {
			$avatar = $this->request->getFile('file');
			$avatar->move(WRITEPATH . 'uploads');
			$data = [
				'name' 	=> $avatar->getClientName(),
				'type' 	=> $avatar->getClientMimeType(),
				'ext' 	=> $avatar->getClientExtension(),
				'size' 	=> $avatar->getSize('kb'),
				'user_id' 	=> session()->get('id_user'),
			];
			$save = $builder->insert($data);
			$msg = 'Archivo subido correctamente.';
		}
		return redirect()->to(base_url('uploads/index'))->with('msg', $msg);
	}

	public function multipleImages(){
		helper(['form', 'url']);
		$db 		= \Config\Database::connect();
		$builder 	= $db->table('files');
		$msg = 'Error al subir los archivos.';
		if ($this->request->getFileMultiple('file')) {
			foreach($this->request->getFileMultiple('file') as $file){
				$file->move(WRITEPATH . 'uploads');
				$data = [
					'name' =>  $file->getClientName(),
					'type'  => $file->getClientMimeType(),
					'ext' 	=> $file->getClientExtension(),
					'size' 	=> $file->getSize('kb'),
					'user_id' 	=> session()->get('id_user'),
				];
				$save = $builder->insert($data);
				$msg = 'Archivos subidos correctamente.';
			}
		}
		return redirect()->to(base_url('uploads/index'))->with('msg', $msg);
	}

	public function store_img_ajx(){
		helper(['form', 'url']);
		$db      	= \Config\Database::connect();
		$builder 	= $db->table('files');
		$validated 	= $this->validate([
			'file' 	=> [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[file,4096]',
			],
		]);

		$response = [
			'msg' => "Error al subir el archivo.",
			'tipo' => "danger",
			"icon" => "fa fa-exclamation-circle",
		];

		if ($validated) {
			$file = $this->request->getFile('file');
			$file->move(WRITEPATH . 'uploads');
			$data = [
				'name' =>  $file->getClientName(),
				'type'  => $file->getClientMimeType(),
				'ext' 	=> $file->getClientExtension(),
				'size' 	=> $file->getSize('kb'),
				'user_id' 	=> session()->get('id_user'),
			];
			$save = $builder->insert($data);
			$response = [
				'msg' => "Imagen subida correctamente.",
				'tipo' => "success",
				"icon" => "fa fa-check",
			];
		}else{
			$response = [
				'msg' => "Error en el tipo o tamaño de archivo.",
				'tipo' => "danger",
				"icon" => "fa fa-exclamation-circle",
			];
		}

		return $this->response->setJSON($response);
	}

	public function store_images_ajx(){
		helper(['form', 'url']);
		$db      	= \Config\Database::connect();
		$builder 	= $db->table('files');
		$response = [
			'success' => false,
			'msg' => "Error al subir el archivo.",
			'tipo' => "danger",
			"icon" => "fa fa-exclamation-circle",
		];

		if ($this->request->getFileMultiple('file')) {
			foreach($this->request->getFileMultiple('file') as $file){
				$file->move(WRITEPATH . 'uploads');
				$data = [
					'name' =>  $file->getClientName(),
					'type'  => $file->getClientMimeType(),
					'ext' 	=> $file->getClientExtension(),
					'size' 	=> $file->getSize('kb'),
					'user_id' 	=> session()->get('id_user'),
				];
				$save = $builder->insert($data);
			}
			$response = [
				'success' => true,
				'msg' => "Imágenes subidas correctamente.",
				'tipo' => "success",
				"icon" => "fa fa-check",
			];
		}

		return $this->response->setJSON($response);
	}


	public function upimg(){
		helper(['form', 'url']);
		$db      	= \Config\Database::connect();
		$builder 	= $db->table('files');
		$response = [
			'uploaded' => false,
			"url" => "",
		];

		$file = $this->request->getFile('upload');
		$nom_img = fraseAleatoria(4).'-'.fraseAleatoria(4).'.'.$file->getClientExtension();

		if ($file->move('public/files/posts/', $nom_img)) {
			$response = [
				'uploaded' => true,
				"url" => base_url('public/files/posts/'.$nom_img),
			];
		}
		/*if ($this->request->getFileMultiple('upload')) {
			foreach($this->request->getFileMultiple('upload') as $file){
				$file->move(WRITEPATH . 'uploads');
				$data = [
					'name' =>  $file->getClientName(),
					'type'  => $file->getClientMimeType(),
					'ext' 	=> $file->getClientExtension(),
					'size' 	=> $file->getSize('kb'),
					'user_id' 	=> session()->get('id_user'),
				];
				//$save = $builder->insert($data);
			}
			$response = [
				'uploaded' => true,
				"url" => base_url('/public/'.$data['name']),
			];
		}*/

		return $this->response->setJSON($response);
	}
}
