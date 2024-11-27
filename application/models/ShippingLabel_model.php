<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShippingLabel_model extends CI_Model
{

    // Menyimpan data label pengiriman
    public function simpan_label($data)
    {
        $this->db->insert('shipping_labels', $data);
        return $this->db->insert_id(); // Kembalikan ID shipping label yang baru dibuat
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

    public function get_shipping_label_by_transaksi_master($id_transaksi_master)
{
    $this->db->select('shipping_labels.id');
    $this->db->from('shipping_labels');
    $this->db->where('shipping_labels.id_transaksi_master', $id_transaksi_master);
    $query = $this->db->get();
    return $query->row();
}

public function get_barang_by_transaksi_master($id_transaksi_master) {
    $this->db->select('barang.nama_barang, transaksi_stok.jumlah, barang.berat');
    $this->db->from('transaksi_stok');
    $this->db->join('barang', 'barang.id_barang = transaksi_stok.id_barang');
    $this->db->where('transaksi_stok.id_transaksi_master', $id_transaksi_master);
    return $this->db->get()->result();
}
public function create_shipping_label($data) {
    return $this->db->insert('shipping_labels', $data);
}


}
