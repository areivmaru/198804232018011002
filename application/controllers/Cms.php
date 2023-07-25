<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends MY_Controller
{
    public function index()
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

    public function user()
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

    function data1_json()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://103.226.55.159/json/data_rekrutmen.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

        ));

        $response = curl_exec($curl);
        $json = json_decode($response, true);

        curl_close($curl);
        return $json;
    }

    function data2_json()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://103.226.55.159/json/data_attribut.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

        ));

        $response = curl_exec($curl);
        $json = json_decode($response, true);

        curl_close($curl);
        return $json;
    }


    function users_json()
    {
        $data1 = $this->data1_json();
        $data2 = $this->data2_json();
        

        foreach ($data1['Form Responses 1'] as $key1 => $value1) {
            foreach ($data2 as $key2 => $value2) {
                if ($value1['id']==$value2['id_pendaftar']) {
                    // array_push($value1[]['attr'], $value2['jenis_attr']);
                    // array_push($value1[]['val'], $value2['value']);
                    
                    $result[]=$value2+$value1;
                }
            }
        }


        // $no = 1;
        // foreach ($data1 as $k => $v) {
        //     $data1[$k]['no'] = $no;
        //     $no++;
        // }
        // var_dump($data1['Form Responses 1']);die()
        // $data2 = $this->data2_json();
        // $no = 1;
        // foreach ($data1 as $k => $v) {
        //     foreach ($data2 as $key) {
        //         if ($key['id_pengguna'] == $v['id']) {
        //             $data1[$k]['jenis_attr'] = $key['jenis_attr'];
        //             $data1[$k]['value'] = $key['value'];
        //         }
        //     }
        //     $data1[$k]['no'] = $no;
        //     $no++;
        // }
        echo json_encode(array('data' => $result));
    }
}
