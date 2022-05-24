<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function index()
	{
		//Set Parameter
		$judul = 'home';
		$load['judul'] = 'Beranda';
        $load['isi'] = "v_" . $judul;
		$load['css'] = 'css_home';
		$load['js']  = 'js_home';

		//Load Template
		$this->load->view('front/template/index', $load);
	}

    public function about()
	{
		//Set Parameter
		$judul = 'tentang';
		$load['judul'] = 'Tentang Kami';
        $load['isi'] = "v_" . $judul;
		$load['css'] = '';
		$load['js']  = '';

		//Load Template
		$this->load->view('front/template/index', $load);
	}
}
