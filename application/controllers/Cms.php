<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends MY_Controller
{
	public function index()
	{
		//Set Parameter
		$judul = 'dashboard';
		$load['judul'] = 'Dashboard';
        $load['isi'] = "v_" . $judul;
		$load['css'] = 'css_dashboard';
		$load['js']  = 'js_dashboard';

		//Load Template
		$this->load->view('cms/template/index', $load);
	}

    public function user()
	{
		//Set Parameter
		$judul = 'user';
		$load['judul'] = 'Pengguna';
        $load['isi'] = "v_" . $judul;
		$load['css'] = 'css_user';
		$load['js']  = 'js_user';

		//Load Template
		$this->load->view('cms/template/index', $load);
	}
}
