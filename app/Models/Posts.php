<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Posts extends Model{
	protected $table 			= 'ajx_posts';
	protected $primaryKey 		= 'id_post';
	protected $allowedFields 	= ['id_post', 'fc_post', 'act_post', 'slug_post', 'nom_post', 'desc_post', 'img_post', 'user_id'];
	protected $returnType 		= 'object';

	protected $db;
	/*public function __construct(){
		$this->db = $db = \Config\Database::connect();
	}*/

	public function get_postById($data) {
		$this->db = $db = \Config\Database::connect();
		$builder = $this->db->table('ajx_posts');
		$builder->select('*');
		$builder->where("id_post", $data['id_post']);
		return  $builder->get()->getRow();
	}

	public function get_postBySlug($data) {
		$this->db = $db = \Config\Database::connect();
		$builder = $this->db->table('ajx_posts');
		$builder->select('*');
		$builder->where("slug_post", $data['slug_post']);
		return  $builder->get()->getRow();
	}

	public function getAll() {
		$this->db = $db = \Config\Database::connect();
		$builder = $this->db->table('ajx_posts');
		$builder->select('*');
		$query   = $builder->get();
		$results = $query->getResult();
        return $results;
	}
}