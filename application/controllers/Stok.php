<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stok_model');
    }

    public function index() {
        // Menampilkan halaman stok (barang masuk/keluar)
        $this->load->view('stok');
    }

    public function tambah_barang_masuk() {
        $this->load->model('Stok_model');
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'jenis_transaksi' => 'masuk', // Jenis transaksi masuk
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('keterangan'),
            'tanggal' => date('Y-m-d H:i:s')
        );
        $this->Stok_model->tambah_barang_masuk($data);
        redirect('stok/list');
    }
    
    public function tambah_barang_keluar() {
        $this->load->model('Stok_model');
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'jenis_transaksi' => 'keluar', // Jenis transaksi keluar
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('keterangan'),
            'tanggal' => date('Y-m-d H:i:s')
        );
        $this->Stok_model->tambah_barang_keluar($data);
        redirect('stok/list');
    }
    // Fungsi untuk menambah barang baru
    public function tambah_barang() {
        $this->load->view('stok/tambah_barang');
    }

    // Fungsi untuk menyimpan barang baru ke database
    public function simpan_barang() {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'stok_minimum' => $this->input->post('stok_minimum'),
            'berat' => $this->input->post('berat'),
            'kode_barang' => $this->input->post('kode_barang')
        ];
        
        $this->Stok_model->tambah_barang($data);
        redirect('stok/daftar_barang');
    }

    // Fungsi untuk melihat daftar barang
    public function daftar_barang() {
        $data['barang'] = $this->db->get('barang')->result_array();
    $this->load->view('stok/daftar_barang', $data);
    }

    // Fungsi untuk edit barang
    public function edit_barang($id_barang) {
        $data['barang'] = $this->Stok_model->get_barang_by_id($id_barang);
        $this->load->view('stok/edit_barang', $data);
    }

    // Fungsi untuk update barang
    public function update_barang($id_barang) {
        $data['barang'] = $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
        $this->load->view('stok/update_barang', $data);
    }

    // Fungsi untuk menghapus barang
    public function hapus_barang($id_barang)
    {
    // Periksa apakah barang dengan ID tersebut ada
    $barang = $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
    if (!$barang) {
        show_404(); // Jika tidak ditemukan, tampilkan error 404
    }

    // Hapus data barang dari database
    $this->db->delete('barang', ['id_barang' => $id_barang]);

    // Redirect ke halaman daftar barang
    redirect('stok/daftar_barang');
    }

    // Fungsi untuk mencatat barang masuk
    public function barang_masuk() {
        $this->load->view('stok/barang_masuk');
    }

    // Fungsi untuk menyimpan transaksi barang masuk
    public function simpan_barang_masuk() {
        $data = [
            'id_barang' => $this->input->post('id_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date('Y-m-d')
        ];
        
        $this->Stok_model->transaksi_masuk($data);
        redirect('stok/daftar_barang');
    }

    // Fungsi untuk mencatat barang keluar
    public function barang_keluar() {
        $this->load->view('stok/barang_keluar');
    }

    // Fungsi untuk menyimpan transaksi barang keluar
    public function simpan_barang_keluar() {
        $data = [
            'id_barang' => $this->input->post('id_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => date('Y-m-d')
        ];
        
        $this->Stok_model->transaksi_keluar($data);
        redirect('stok/daftar_barang');
    }

    public function simpan_update_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'kode_barang' => $this->input->post('kode_barang'),
            'stok_minimum' => $this->input->post('stok_minimum'),
            'berat' => $this->input->post('berat'),
        ];
        $this->db->update('barang', $data, ['id_barang' => $id_barang]);
        redirect('stok/daftar_barang');
    }
    public function stok_real()
    {
        // Mengambil data stok real dari model
        $data['stok'] = $this->Stok_model->get_stok_real();
        
        // Menampilkan data ke halaman view
        $this->load->view('stok/stok_real', $data);
    }

}
