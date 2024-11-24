<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function login($username, $password)
{
    // Cek user berdasarkan username dan password
    $this->db->where('username', $username);
    $this->db->where('password', md5($password));  // Pastikan password terenkripsi jika menggunakan md5 atau hash lain
    $query = $this->db->get('pegawai');

    // Jika ada hasil, kembalikan data user
    if ($query->num_rows() == 1) {
        return $query->row();  // Mengembalikan objek pengguna pertama
    } else {
        return false;  // Jika tidak ada user yang cocok
    }
}
    
    public function check_login()
    {
        // Jika session login tidak ada, redirect ke halaman login
        if (!$this->session->userdata('id_pegawai')) {
            redirect('login');
        }
    }

    public function logout()
    {
        // Hapus session login
        $this->session->sess_destroy();
        redirect('login');
    }
}
?>
