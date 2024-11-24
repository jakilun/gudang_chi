<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->Auth_model->check_login(); // Pastikan user sudah login
        $this->load->model('Stok_model');  // Memuat model Stok_model
    }

    public function index() {
        // Ambil data peringatan stok menipis
        $stok_menipis = $this->Stok_model->peringatan_stok();

        // Kirim data ke view
        $data['stok_menipis'] = $stok_menipis;

        // Tampilkan halaman dashboard
        $this->load->view('dashboard', $data);
    }
}
