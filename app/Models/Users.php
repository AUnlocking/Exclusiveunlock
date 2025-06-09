<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Users extends Model{
	protected $table 			= 'users';
	protected $primaryKey 		= 'id_user';
	protected $allowedFields 	= ['id_user', 'nom_user', 'email', 'password', 'act_user', 'fc_user'];
	protected $returnType 		= 'object';

	protected $db;
	/*public function __construct(){
		$this->db = $db = \Config\Database::connect();
	}*/
}