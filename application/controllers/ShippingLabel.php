<?php
use Mpdf\Mpdf;
defined('BASEPATH') OR exit('No direct script access allowed');
class ShippingLabel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ShippingLabel_model');
        $this->load->model('Transaksi_model');
        $this->load->library('form_validation');

    }

    // Halaman form tambah label pengiriman
    public function index() {
    }
    //Buat Shipping Label
    public function create()
    {
        $transaksi_id = $this->input->get('transaksi_id');
        $data['id_transaksi'] = $transaksi_id; // Kirim variabel ke view
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_id($transaksi_id);
    
        $this->load->view('shipping_label/tambah', $data);
    }
    
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
                'id_transaksi' => $this->input->post('id_transaksi')
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
    $data['label'] = $this->ShippingLabel_model->get_label_by_id($id);

    if (!$data['label']) {
        show_404();
    }

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
}
