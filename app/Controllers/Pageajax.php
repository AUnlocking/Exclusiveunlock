<?php
namespace App\Controllers;
use App\Models\Posts;

class Pageajax extends BaseController{

	protected $helpers = [];
	protected $db;

	public function __construct(){
		helper(['url', 'session', 'emai', 'upload', 'system_helper', 'database']);
		$this->db = $db = \Config\Database::connect();
	}

	public function index(){
		$data['title'] 	= 'Codeigniter 4 | LiNuXiToS';
		$data['tab'] 	= 'pageajax';
		return view('pageajax', $data);
	}

	public function loadContent($record = 1) {
		$posts 				= new Posts();
		$data['page'] 		= $record>0? $record : 1;
		$data['per_page'] 	= 8;
		$data['offset'] 	= ($data['page'] - 1) * $data['per_page'];
		$total 				= $posts->countAll();
		$total_pages 		= ceil($total/$data['per_page']);
		$data['adyacentes'] = 2;
		$reload 			= base_url('pageajax/loadContent');

		$db      = \Config\Database::connect();
		$builder = $db->table('ajx_posts as sec');
		$builder->select("sec.*");
		$builder->orderBy('nom_post', 'asc');
		$builder->limit($data['per_page'], $data['offset']);
		$query 			= $builder->get();
		$list_search 	= $query->getResult();

		$data['search'] = "";

		if ($list_search) {
			foreach ($list_search as $post) {
				$img = base_url('assets/app/images/default_post.png');
				if (file_exists('public/'.$post->img_post)) {
					$img = base_url('/public/'.$post->img_post);
				}
				$data['search'] .= '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-2 d-flex">
					<div class="card mb-2 post border-bottom-2" style="width:100%;">
							<a href="'.base_url('post/'.$post->slug_post).'">
								<div class="post-image rounded">
									<img src="'.$img.'" class="" alt="" sizes="(max-width: 272px) 100vw, 272px">
								</div>
							</a>
							<div class="card-body font-weight-bold ">
								<a class="text-dark" href="'.base_url('post/'.$post->slug_post).'">
									'.$post->nom_post.'
								</a>
								<div>
									<small class="float float-right"><span class="byline-author-label">By</span>
										<a class="byline-author-name-link" href="#" title="LiNuXiToS">LiNuXiToS</a></small>
									<small>'.mesDiaAnio($post->fc_post).'</small>
								</div>
							</div>
						</div>
				</div>';
			}
			$data['pagination'] = '<span class="pull-right">'.paginate($reload, $data['page'], $total_pages, $data['adyacentes'], 'load').'</span>';
		}else{
			$data['search']='<div class="col-md-12 text-center"><div class="alert alert-danger" role="alert"><i class="fas fa-search"></i> No se encontraron resultados.</div></div>';
		}
		echo json_encode($data);
	}
}
