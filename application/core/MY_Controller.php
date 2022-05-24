<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('FILE_ENCRYPTION_BLOCKS', 10000);
class MY_Controller extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		#MODEL Loads
		$this->load->model('Baseben_Model', 'baseben');
		$this->load->library('encryption');
	}

	function getDomain($address)
	{
		$parseUrl = parse_url(trim($address));
		$host_names = explode(".", $parseUrl['host']);
		$domain = '';
		for ($i = count($host_names) - 1; $i > 0; $i--) {
			$domain .= $host_names[count($host_names) - $i];
			if ($i != 1) {
				$domain .= '.';
			}
		}
		return $domain;
	}

	function is_login()
	{
		 if ($this->session->userdata['sisp_in'] != 1) {
			redirect(base_url());
		}
	}

	function is_admin()
	{
		$this->is_login();
		if ($this->session->userdata['role'] != 'administrator') {
			redirect(base_url());
		}
	}

	

	function update_status()
	{
		$data_post = $this->input->post();

		$data = array(
			'table_name' => $data_post['table_name'],
			'status' => $data_post['status'],
			'updatedon' => date('Y-m-d H:i:s'),
			'updatedby' => $this->session->userdata('nip'),
			'key' => $data_post['key'],
			'key_name' => $data_post['key_name']
		);

		$query = $this->baseben->update($data);

		if ($query) {
			echo json_encode(array('kode' => 200, 'keterangan' => 'Status berhasil di update'));
		} else {
			echo json_encode(array('kode' => 500, 'keterangan' => 'Status gagal di update'));
		}
	}


	function set_cookie()
	{
		$post = $this->input->post();
		if (is_array($post)) {
			foreach ($post as $k => $v) {
				set_cookie($v['name'], $v['value'], $v['expire']);
			}
		}
	}

	function _upload($id_input, $jenis, $name = null)
	{
		$path = './res/upload/' . $jenis . '/' . date('Y') . '/';

		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		$this->load->library('upload');

		$config = array(
			'upload_path' => $path,
			'allowed_types' => "png|jpg|jpeg|webp|pdf|docx|doc|ppt|xlsx|xls|pptx",
			'overwrite' => TRUE,
			'encrypt_name' => TRUE,
			'max_size' => "50000"
		);

		if ($name) {
			$config['file_name'] = $name;
		}

		$this->upload->initialize($config);

		if ($this->upload->do_upload($id_input)) {
			return $this->upload->data("file_name");
		} else {
			return $this->upload->display_errors();
		}
	}
	function multiple_upload($input_name, $jenis, $files, $id)
	{
		$path = './res/upload/' . $jenis . '/' . date('Y') . '/' . $id . '/';
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		$config = array(
			'upload_path'   => $path,
			'overwrite'     => 1,
			'encrypt_name' => TRUE,
			'allowed_types' => 'gif|jpg|png|docx|doc|xls|xlsx|pdf|zip|rar|jpeg|ppt|pptx'
		);

		$this->load->library('upload', $config);

		$images = array();

		foreach ($files['name'] as $key => $image) {
			if (!empty($files['name'][$key])) {
				$_FILES[$input_name]['name'] = $files['name'][$key];
				$_FILES[$input_name]['type'] = $files['type'][$key];
				$_FILES[$input_name]['tmp_name'] = $files['tmp_name'][$key];
				$_FILES[$input_name]['error'] = $files['error'][$key];
				$_FILES[$input_name]['size'] = $files['size'][$key];
				$fileName = date('YmdHis') . '_' . $image;
				$config['file_name'] = $fileName;

				$this->upload->initialize($config);

				if ($this->upload->do_upload($input_name)) {
					$upload_data = $this->upload->data();
					$images[] = $upload_data['file_name'];
				} else {
					return false;
				}
			}
		}
		return $images;
	}

	public static function slugify($text, string $divider = '-')
	{
		// replace non letter or digits by divider
		$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, $divider);

		// remove duplicate divider
		$text = preg_replace('~-+~', $divider, $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}

	function download($dir, $year, $filename)
	{
		$this->load->helper('download');
		$dir = str_replace('-', '/', $dir);
		force_download('./res/upload/' . $dir . '/' . $year . '/' . $filename, NULL);
	}

	function download_image_url($url, $path, $filename)
	{
		try {
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}
			$ch = curl_init($url);
			$fp = fopen($path . '/' . $filename, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
			return $path;
		} catch (Exception $e) {
			return false;
		}
	}

	function send_mail($email_data = NULL)
	{
		if (is_null($email_data)) {
			$email_data = array(
				'from' => $this->input->post('from'),
				'sender' => $this->input->post('sender'),
				'to' => $this->input->post('to'),
				'subject' => $this->input->post('subject'),
				'message' => $this->input->post('message')
			);
		}
		$this->load->library('email');

		$this->email->from($email_data->from, $email_data->sender);
		$this->email->to($email_data->to);
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		if (count($email_data->attachment) > 0) {
			foreach ($email_data->attachment as $attachment_files) {
				$this->email->attach($attachment_files);
			}
		}

		if ($this->email->send()) {
			return TRUE;
		} else {
			$this->session->set_flashdata('email_error', $this->email->print_debugger());
			return FALSE;
		}
	}

	function validateDate($date, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) === $date;
	}

	public function log($type, $body, $nip, $callback = null)
	{
		$this->load->library('user_agent');

		if ($this->agent->is_browser()) {
			$agent = $this->agent->browser() . ' ' . $this->agent->version();
		} elseif ($this->agent->is_robot()) {
			$agent = $this->agent->robot();
		} elseif ($this->agent->is_mobile()) {
			$agent = $this->agent->mobile();
		} else {
			$agent = 'Unidentified User Agent';
		}
		$agent = $agent . '-' . $this->agent->platform();
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];

		$con = array(
			'table_name' => 'activity_log',
			'type' => $type,
			'user_agent' => $agent,
			'ip' => $ipaddress,
			'createdon' => date('Y-m-d H:i:s'),
			'nip' => $nip,
			'body' => $body,
			'callback' => $callback
		);
		$this->baseben->insert($con);
	}
}
