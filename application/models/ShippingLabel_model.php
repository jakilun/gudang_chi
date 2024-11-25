<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShippingLabel_model extends CI_Model
{

    // Menyimpan data label pengiriman
    public function simpan_label($data)
    {
        $this->db->insert('shipping_labels', $data);
    }

    // Mengambil semua data label pengiriman
    public function get_all_labels()
    {
        return $this->db->get('shipping_labels')->result();
    }

    // Mengambil data label pengiriman berdasarkan ID
    public function get_label_by_id($id)
    {
        return $this->db->get_where('shipping_labels', ['id' => $id])->row();
    }

    public function is_label_created($transaksi_id)
    {
        return $this->db->where('id_transaksi', $transaksi_id)->count_all_results('shipping_labels') > 0;
    }

    public function get_suggestions($query)
    {
        $this->db->like('nama_penerima', $query);
        $this->db->select('nama_penerima, telepon_penerima, alamat_penerima');
        $this->db->group_by('nama_penerima'); // Hindari duplikasi
        return $this->db->get('shipping_labels')->result_array();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('shipping_labels', $data);
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('shipping_labels');
    }

}
