<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat library form_validation
        $this->load->library('form_validation');
        // Memuat model jika diperlukan
        $this->load->model('Auth_model');
    }

    public function index()
    {

        // Validasi form input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika form tidak valid, kembali ke halaman login
            $this->load->view('login');
        } else {
            // Ambil data dari form input
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Panggil model untuk mengecek kredensial
            $user = $this->Auth_model->login($username, $password);

            // Jika user ditemukan
            if ($user) {
                // Simpan data user di session
                $this->session->set_userdata('id_pegawai', $user->id_pegawai);
                $this->session->set_userdata('nama_pegawai', $user->nama_pegawai);
                $this->session->set_userdata('role', $user->role);

                // Redirect ke halaman utama setelah login sukses
                redirect('dashboard');
            } else {
                // Jika user tidak ditemukan, tampilkan pesan error
                $this->session->set_flashdata('error', 'Username atau password salah');
                redirect('login');
            }
        }
    }
    public function logout()
{
    // Hancurkan semua session
    $this->session->sess_destroy();

    // Redirect ke halaman login setelah logout
    redirect('login');
}
}
?>