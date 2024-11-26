<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    // Menambah transaksi stok (masuk/keluar)
    public function tambah_transaksi($data)
    {
        return $this->db->insert('transaksi_stok', $data);
    }

    // Mendapatkan semua transaksi stok
    public function get_all_transaksi()
    {
        $this->db->select('transaksi_stok.*, barang.nama_barang');
        $this->db->from('transaksi_stok');
        $this->db->join('barang', 'barang.id_barang = transaksi_stok.id_barang');
        return $this->db->get()->result();
    }

    public function get_transaksi_filtered($filter)
    {
        // Mulai query
        $this->db->select('transaksi_stok.*, barang.nama_barang, barang.kode_barang');
        $this->db->from('transaksi_stok');
        $this->db->join('barang', 'barang.id_barang = transaksi_stok.id_barang');

        // Filter berdasarkan id_barang (produk)
        if (!empty($filter['id_barang'])) {
            $this->db->where('transaksi_stok.id_barang', $filter['id_barang']);
        }

        // Filter berdasarkan tanggal
        if (!empty($filter['waktu'])) {
            $this->db->where('DATE(transaksi_stok.waktu)', $filter['waktu']);
        }

        // Eksekusi query dan ambil hasilnya
        $query = $this->db->get();
        return $query->result();
    }


    public function get_transaksi_by_id($id)
    {
        $this->db->where('id_transaksi', $id);
        $query = $this->db->get('transaksi_stok');
        return $query->row(); // Mengembalikan objek data transaksi
    }

    public function update_transaksi($id, $data)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->update('transaksi_stok', $data);
    }

    // Fungsi untuk menghapus transaksi

    // Mendapatkan transaksi stok berdasarkan ID barang
    public function get_transaksi_by_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->get('transaksi_stok')->result_array();
    }
    public function filter_transaksi($id_barang = null, $tanggal_awal = null, $tanggal_akhir = null, $jenis_transaksi = null)
    {
        $this->db->select('transaksi_stok.*, barang.nama_barang, barang.kode_barang');
        $this->db->from('transaksi_stok');
        $this->db->join('barang', 'barang.id_barang = transaksi_stok.id_barang');

        if ($id_barang) {
            $this->db->where('transaksi_stok.id_barang', $id_barang);
        }

        if ($tanggal_awal && $tanggal_akhir) {
            $this->db->where('DATE(transaksi_stok.waktu) >=', $tanggal_awal);
            $this->db->where('DATE(transaksi_stok.waktu) <=', $tanggal_akhir);
        }
        if ($jenis_transaksi) {
            $this->db->where('transaksi_stok.jenis_transaksi', $jenis_transaksi);
        }
        // Urutkan dari terbaru ke terlama
        $this->db->order_by('transaksi_stok.waktu', 'DESC');

        return $this->db->get()->result();
    }

    public function get_shipping_label_by_transaksi($id_transaksi)
{
    $this->db->select('shipping_labels.id');
    $this->db->from('shipping_labels');
    $this->db->where('shipping_labels.id_transaksi', $id_transaksi);
    $query = $this->db->get();
    return $query->row();
}


}