<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get_where('barang', ['date_deleted' => null])->result_array();
    }

    public function insert($new_data)
    {
        return $this->db->insert('barang', $new_data);
    }

    public function hapus($id)
    {
        $this->db->delete('items', array('id' => $id));
    }
}
