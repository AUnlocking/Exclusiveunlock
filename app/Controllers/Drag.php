<?php
namespace App\Controllers;
use App\Models\Posts;

class Drag extends BaseController{
	protected $helpers = [];
	protected $db;

	public function __construct(){
		helper(['url', 'session', 'emai', 'upload', 'system_helper', 'database']);
		$this->db 			= $db = \Config\Database::connect();
	}

	public function index(){
		$data['title'] 	= 'Drag&drop files | LiNuXiToS';
		$data['tab'] 	= 'dragdrop';
		return view('dragdrop', $data);
	}

	public function upfiles(){
		$db      	= \Config\Database::connect();
		$builder 	= $db->table('files');
		
		$i=0;
		if ($this->request->getFileMultiple('file')) {
			foreach($this->request->getFileMultiple('file') as $file){
				$file->move(WRITEPATH.'uploads');
				$data = [
					'name' 		=> $file->getClientName(),
					'type'  	=> $file->getClientMimeType(),
					'ext' 		=> $file->getClientExtension(),
					'size' 		=> $file->getSize('kb'),
					'user_id' 	=> session()->get('id_user'),
				];
				$save = $builder->insert($data);
				$i++;
			}
		}

		$response = [
			'msg' => "Imagen subida correctamente.total:".$i,
			'tipo' => "success",
			"icon" => "fa fa-check",
		];

		return $this->response->setJSON($response);
	}
}
