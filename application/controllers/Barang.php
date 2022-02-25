<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
    }

    public function index()
    {
        $data['title'] = 'Data Barang';
        $data['barang'] = $this->Barang_model->getAll();
        $this->load->view('barang', $data);
    }

    public function tambah()
    {

        $nama_barang = $this->input->post('nama_barang');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $stok = $this->input->post('stok');
        $foto_barang = $this->input->post('foto_barang');

        $this->form_validation
            ->set_rules('nama_barang', 'Nama Barang', 'required')
            ->set_rules('harga_beli', 'Harga beli', 'required')
            ->set_rules('harga_jual', 'Harga jual', 'required')
            ->set_rules('stok', 'Stok', 'required');

        if ($this->form_validation->run() == false) {
            $json['error'] = $this->form_validation->get_errors();
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
            return;
        }


        if ($this->input->method() === 'post') {
            $file_name = md5(preg_replace('/\s+/', '_', $nama_barang));

            $config['upload_path']          = FCPATH . '/storage/images/';
            $config['allowed_types']        = 'jpg|jpeg|png';
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $config['max_size']             = 1024;
            $config['max_width']            = '*';
            $config['max_height']           = '*';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto_barang')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $uploaded_data = $this->upload->data();

                // echo '<pre>';
                // print_r($uploaded_data);
                // return;

                $new_data = [
                    'nama_barang' => $nama_barang,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'stok' => $stok,
                    'foto_barang' => $uploaded_data['file_name'],
                    'date_added' => date('Y-m-d H:i:s'),
                ];

                if ($this->Barang_model->insert($new_data)) {
                    $json['success'] = 1;
                } else {
                    $json['error_action'] = 1;
                }

                $this->output->set_content_type('application/json')->set_output(json_encode($json));
            }
        }
    }

    public function hapus($id)
    {
        $json = array();
        if ($id != null) {
            $this->db->update('barang', array('date_deleted' => date('Y-m-d H:i:s')), array('id' => $id));
        }
        $json['success'] = 1;
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
}
