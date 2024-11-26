<?php
class TransaksiBarang_model extends CI_Model {
    public function insert($data) {
        $this->db->insert('transaksi_barang', $data);
    }

    public function get_by_transaksi($id_transaksi) {
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('transaksi_barang')->result();
    }
}
