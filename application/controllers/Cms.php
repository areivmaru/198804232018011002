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
		$load['menu'] = $judul;
		$load['judul'] = 'Pengguna';
        $load['isi'] = "v_" . $judul;
		$load['css'] = 'css_user';
		$load['js']  = 'js_user';

		//Load Template
		$this->load->view('cms/template/index', $load);
	}


	function users_json()
    {
        $con = array(
            'table_name' => 'user',
            'order_by' => array('status', 'DESC'),
            'where' => array('status !=' => 'Deleted')
        );

        if (!empty($this->input->post('user_id'))) {
            $con['where'] = array(
                'user_id' => $this->input->post('user_id')
            );
        }
        $get = $this->baseben->get($con);
        $no = 1;
        foreach ($get as $k => $v) {
            $get[$k]['no'] = $no;
            $no++;
        }
        echo json_encode(array('data' => $get));
    }

	function crud_users()
    {
        $data_post = $this->input->post();
        $data = array(
            'table_name' => 'user',
			'nip' => $data_post['nip'],
			'nama' => $data_post['nama'],
            'email' => $data_post['email'],
            'status' => 'Aktif'
        );

        if (!empty($data_post['password'])) {
            $data['password'] = hash('sha256', sha1(md5($data_post['password'])));
        }

		if ($_FILES['foto']['name'] != '') {
            $data['foto'] = $this->_upload('foto', 'user');
        }

        if (!empty($data_post['user_id'])) {
            $data['key_name'] = "user_id";
            $data['key'] = $data_post['user_id'];
            $data['updatedby'] = $this->session->userdata('nip');
            $data['updatedon'] = date('Y-m-d H:i:s');
            $query = $this->baseben->update($data);
        } else {
            $data['createdby'] = $this->session->userdata('nip');
            $data['createdon'] = date('Y-m-d H:i:s');
            $query = $this->baseben->insert($data);
        }

        if ($query) {
            $this->session->set_flashdata('alert', 'success');
            $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
        } else {
            $this->session->set_flashdata('alert', 'error');
            $this->session->set_flashdata('message', 'Data Gagal Disimpan');
        }
        redirect(base_url() . 'cms/pengguna');
    }
}
