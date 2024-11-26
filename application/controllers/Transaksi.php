<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Ganti dengan Stok_model
        $this->load->model('Stok_model');
        $this->load->model('Transaksi_model');
        $this->load->model('ShippingLabel_model');
    }

    // Menampilkan form untuk menambah transaksi stok
    public function tambah()
    {
        $data['barang'] = $this->Stok_model->get_all_barang(); // Ambil semua data barang
        $this->load->view('transaksi/tambah_transaksi', $data);
    }

    // Menyimpan transaksi stok (masuk/keluar)
    public function simpan()
    {
        $data = [
            'id_barang' => $this->input->post('id_barang'),
            'jenis_transaksi' => $this->input->post('jenis_transaksi'),
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('keterangan'),
            'waktu' => date('Y-m-d H:i:s'), // Pastikan format ini digunakan
        ];
        // Simpan data transaksi ke database
        if ($this->Transaksi_model->tambah_transaksi($data)) {
            // Redirect ke daftar transaksi atau halaman sukses
            redirect('transaksi/daftar');
        } else {
            // Tampilkan pesan error jika gagal
            echo "Gagal menyimpan transaksi!";
        }
    }

    // Menampilkan daftar transaksi stok
    //public function daftar()
    //{
    //    $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();

        // Ambil data filter dari query string
    //    $filter = array(
    //        'id_barang' => $this->input->get('id_barang'),
    //        'waktu' => $this->input->get('waktu')
    //    );

        // Ambil data barang untuk dropdown filter
    //    $data['barang'] = $this->Stok_model->get_all_barang();

        // Ambil data transaksi dengan filter
    //    $data['transaksi'] = $this->Transaksi_model->get_transaksi_filtered($filter);

    //    // Kirim data ke view
    //    $data['filter'] = $filter;  // Untuk mengingatkan pilihan filter yang sudah dipilih

    //    $this->load->view('transaksi/daftar_transaksi', $data);

        
    //}
    public function daftar()
{
    $id_barang = $this->input->get('id_barang');
    $tanggal_awal = $this->input->get('tanggal_awal');
    $tanggal_akhir = $this->input->get('tanggal_akhir');
    $jenis_transaksi = $this->input->get('jenis_transaksi');
    $data['tanggal_awal'] = $tanggal_awal;
    $data['tanggal_akhir'] = $tanggal_akhir;
    $data['id_barang'] = $id_barang;

    $this->load->model('Transaksi_model');
    $data['barang'] = $this->Stok_model->get_all_barang();
    $data['transaksi'] = $this->Transaksi_model->filter_transaksi($id_barang, $tanggal_awal, $tanggal_akhir, $jenis_transaksi);
    
    foreach ($data['transaksi'] as $key => $transaksi) {
        $shipping_label = $this->ShippingLabel_model->get_shipping_label_by_transaksi($transaksi->id_transaksi);
        $data['transaksi'][$key]->id = $shipping_label ? $shipping_label->id : null;
        $transaksi->label_created = $this->ShippingLabel_model->is_label_created($transaksi->id_transaksi);
    }
    // Tambahkan status shipping label untuk setiap transaksi

    if (empty($data['transaksi'])) {
        $data['transaksi'] = []; // jika tidak ada data, gunakan array kosong
    }
    $this->load->view('transaksi/daftar_transaksi', $data);

}


    // Controller Transaksi.php

    public function edit($id)
    {
        $this->load->model('Transaksi_model');
        $this->load->model('Stok_model'); // Model untuk barang

        // Ambil data transaksi berdasarkan ID
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($id);

        // Ambil semua data barang untuk dropdown
        $data['barang'] = $this->Stok_model->get_all_barang();

        if (!$data['transaksi']) {
            show_404(); // Jika transaksi tidak ditemukan
        }
        $this->load->view('transaksi/edit_transaksi', $data);
    }


    public function update($id)
    {
        // Mengambil data dari form
        $data = array(
            'id_barang' => $this->input->post('id_barang'),
            'jenis_transaksi' => $this->input->post('jenis_transaksi'),
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('keterangan'),
            'waktu' => date('Y-m-d H:i:s') // waktu saat transaksi diupdate
        );

        // Mengupdate data transaksi
        $this->Transaksi_model->update_transaksi($id, $data);

        // Redirect ke halaman daftar transaksi setelah update
        redirect('transaksi/daftar');
    }
    //Fungsi Hapus transaksi
    public function hapus($id_transaksi)
    {
        // Periksa apakah barang dengan ID tersebut ada
        $transaksi = $this->db->get_where('transaksi_stok', ['id_transaksi' => $id_transaksi])->row_array();
        if (!$transaksi) {
            show_404(); // Jika tidak ditemukan, tampilkan error 404
        }
        // Hapus data barang dari database
        $this->db->delete('transaksi_stok', ['id_transaksi' => $id_transaksi]);

        // Redirect ke halaman daftar barang
        redirect('transaksi/daftar');
    }
    public function index()
    {
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        echo '<pre>';
        print_r($data['transaksi']);
        echo '</pre>';
        exit; // Berhenti sementara untuk melihat data
    }

}
