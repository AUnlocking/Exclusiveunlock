<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface{
	public function before(RequestInterface $request, $arguments = NULL){
		helper(['url', 'session', 'emai', 'upload', 'system_helper', 'database']);
		// Do something here
		if(! session()->get('isLoggedIn')){
			return redirect()->to(base_url('/'));
			//redireccionar(base_url('ptables'), 'Por favor inicia sesión.', 'danger', 'fa fa-times', ' ', '#');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
		// Do something here
	}
}