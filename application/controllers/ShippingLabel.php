<?php
use Mpdf\Mpdf;
defined('BASEPATH') OR exit('No direct script access allowed');
class ShippingLabel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ShippingLabel_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Auth_model');
        $this->Auth_model->check_login(); // Pastikan user sudah login
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');  // Sesuaikan dengan zona waktu yang diinginkan

    }

    // Halaman form tambah label pengiriman
    public function index() {
    }
    //Buat Shipping Label
    
    // Simpan label pengiriman
    public function simpan() {
        $this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('alamat_penerima', 'Alamat Penerima', 'required');
        $this->form_validation->set_rules('telepon_penerima', 'Nomor Telepon Penerima', 'required');
        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('telepon_pengirim', 'Nomor Telepon Pengirim', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('shipping_label/tambah');
        } else {
            $data = [
                'nama_penerima' => $this->input->post('nama_penerima'),
                'alamat_penerima' => $this->input->post('alamat_penerima'),
                'telepon_penerima' => $this->input->post('telepon_penerima'),
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'telepon_pengirim' => $this->input->post('telepon_pengirim'),
            ];
            $this->ShippingLabel_model->simpan_label($data);
            redirect('shippinglabel/laporan');
        }
    }

    // Halaman laporan daftar label pengiriman
    public function laporan() {
        $data['labels'] = $this->ShippingLabel_model->get_all_labels();
        $this->load->view('shipping_label/laporan', $data);
    }

    // Cetak label pengiriman
    public function print_label($id) {
        $this->load->model('ShippingLabel_model');
        $this->load->model('Transaksi_model');
        $data['label'] = $this->ShippingLabel_model->get_label_by_id($id);
    
        if (!$data['label']) {
            show_404();
        }
    
        // Ambil barang terkait dengan shipping label
        $data['barang'] = $this->ShippingLabel_model->get_barang_by_transaksi_master($data['label']->id_transaksi_master);
    
        // Hitung total berat
        $total_berat = 0;
        foreach ($data['barang'] as $barang) {
            $total_berat += $barang->berat * $barang->jumlah; // Berat per barang * jumlah
        }
        $data['total_berat'] = $total_berat;
    
        // Tampilkan view untuk mencetak label
        $this->load->view('shipping_label/print', $data);
    }
    
    public function get_suggestions() {
        $query = $this->input->get('term'); // Query dari AJAX
        $this->load->model('ShippingLabel_model');
        $results = $this->ShippingLabel_model->get_suggestions($query);
    
        echo json_encode($results); // Kirim hasil sebagai JSON
    }

    public function edit($id) {
        $this->load->model('ShippingLabel_model');
        $data['label'] = $this->ShippingLabel_model->get_label_by_id($id);
    
        if (!$data['label']) {
            show_404();
        }
    
        $this->load->view('templates/header');
        $this->load->view('shipping_label/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update() {
        $id = $this->input->post('id');
        $data = [
            'nama_penerima' => $this->input->post('nama_penerima'),
            'alamat_penerima' => $this->input->post('alamat_penerima'),
            'telepon_penerima' => $this->input->post('telepon_penerima'),
            'nama_pengirim' => $this->input->post('nama_pengirim'),
            'telepon_pengirim' => $this->input->post('telepon_pengirim'),
        ];
    
        $this->load->model('ShippingLabel_model');
        $this->ShippingLabel_model->update($id, $data);
    
        redirect('shippinglabel/laporan');
    }
    
    public function delete($id) {
        $this->load->model('ShippingLabel_model');
        $this->ShippingLabel_model->delete($id);
    
        redirect('shippinglabel/laporan');
    }

    public function create_by_transaksi_master($id_transaksi_master) {
        // Validasi apakah id_transaksi_master ada
        if (empty($id_transaksi_master)) {
            show_error('ID Transaksi Master tidak ditemukan');
        }
    
        // Pastikan request method adalah POST
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Ambil data dari form
            $nama_penerima = $this->input->post('nama_penerima');
            $alamat = $this->input->post('alamat');
            // Ambil data lainnya yang diperlukan untuk shipping label
    
            // Masukkan data ke dalam database
            $this->load->model('ShippingLabel_model');
            $data = [
                'id_transaksi_master' => $id_transaksi_master,
                'nama_penerima' => $this->input->post('nama_penerima'),
                'alamat_penerima' => $this->input->post('alamat_penerima'),
                'telepon_penerima' => $this->input->post('telepon_penerima'),
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'telepon_pengirim' => $this->input->post('telepon_pengirim'),
                'id_transaksi' => $this->input->post('id_transaksi')
            ];
            
            // Simpan data shipping label ke database
            if ($this->ShippingLabel_model->create_shipping_label($data)) {
                // Redirect atau beri notifikasi sukses
                $this->session->set_flashdata('success', 'Shipping label berhasil dibuat');
                redirect('shippinglabel/laporan');
            } else {
                // Tampilkan pesan error jika gagal
                $this->session->set_flashdata('error', 'Gagal membuat shipping label');
                redirect('shippinglabel/create_by_transaksi_master/' . $id_transaksi_master);
            }
        } else {
            // Tampilkan form tambah shipping label jika bukan POST
            $this->load->model('ShippingLabel_model');
            $this->load->model('Transaksi_model');
    
            // Ambil barang terkait transaksi master
            $barang_transaksi = $this->ShippingLabel_model->get_barang_by_transaksi_master($id_transaksi_master);
            if (empty($barang_transaksi)) {
                show_error('Tidak ada barang terkait dengan transaksi ini.');
            }
    
            // Ambil detail transaksi master
            $transaksi_master = $this->Transaksi_model->get_transaksi_master($id_transaksi_master);
    
            // Kirim data ke view
            $data = [
                'id_transaksi_master' => $id_transaksi_master,
                'barang_transaksi' => $barang_transaksi,
                'transaksi_master' => $transaksi_master,
                'id_transaksi_master' => $id_transaksi_master,
            ];
    
            $this->load->view('shipping_label/tambah', $data);
        }
    }
    
    
    
    
}
