<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Memuat database
    }

    public function peringatan_stok() {
        // Menghitung stok yang tersisa berdasarkan transaksi
        $this->db->select('barang.id_barang, barang.nama_barang, 
                           SUM(CASE WHEN transaksi_stok.jenis_transaksi = "masuk" THEN transaksi_stok.jumlah ELSE 0 END) - 
                           SUM(CASE WHEN transaksi_stok.jenis_transaksi = "keluar" THEN transaksi_stok.jumlah ELSE 0 END) as stok_tersisa, 
                           barang.stok_minimum');
        $this->db->from('barang');
        $this->db->join('transaksi_stok', 'barang.id_barang = transaksi_stok.id_barang', 'left');
        $this->db->group_by('barang.id_barang');
        $this->db->having('stok_tersisa < barang.stok_minimum'); // Peringatan stok kurang dari minimum
        return $this->db->get()->result();
    }

    public function tambah_barang_masuk($data) {
        $this->db->insert('transaksi_stok', $data);
    }
    public function tambah_barang_keluar($data) {
        $this->db->insert('transaksi_stok', $data);
    }

    public function get_stok_real()
    {
    // Mengambil data barang beserta jumlah stok masuk dan stok keluar
    $this->db->select('barang.id_barang, barang.nama_barang, 
                       COALESCE(SUM(CASE WHEN transaksi_stok.jenis_transaksi = "masuk" THEN transaksi_stok.jumlah ELSE 0 END), 0) as stok_masuk,
                       COALESCE(SUM(CASE WHEN transaksi_stok.jenis_transaksi = "keluar" THEN transaksi_stok.jumlah ELSE 0 END), 0) as stok_keluar');
    $this->db->from('barang');
    $this->db->join('transaksi_stok', 'barang.id_barang = transaksi_stok.id_barang', 'left');
    $this->db->group_by('barang.id_barang');
    
    // Menghitung stok tersisa
    $query = $this->db->get();
    
    $result = $query->result_array();
    foreach ($result as &$row) {
        $row['stok_tersisa'] = $row['stok_masuk'] - $row['stok_keluar']; // Menghitung stok tersisa
    }

    return $result;
}


    // Fungsi untuk menambah barang
    public function tambah_barang($data) {
        $this->db->insert('barang', $data);
    }

    // Fungsi untuk mengambil semua barang

    public function get_all_barang()
{
    $query = $this->db->get('barang');
    return $query->result();
}

    // Fungsi untuk mengambil barang berdasarkan ID
    public function get_barang_by_id($id_barang) {
        return $this->db->get_where('barang', ['id_barang' => $id_barang])->row();
    }

    // Fungsi untuk mengupdate barang
    public function update_barang($id_barang, $data) {
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $data);
    }

    // Fungsi untuk menghapus barang
    public function hapus_barang($id_barang) {
        $this->db->delete('barang', ['id_barang' => $id_barang]);
    }

    // Fungsi untuk mencatat transaksi barang masuk
    public function transaksi_masuk($data) {
        $this->db->insert('transaksi_stok', $data);
    }

    // Fungsi untuk mencatat transaksi barang keluar
    public function transaksi_keluar($data) {
        $this->db->insert('transaksi_stok', $data);
    }
    
}

