<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['suratjalan/buat_surat_jalan/(:num)'] = 'SuratJalan/buat_surat_jalan/$1';
$route['stok/tambah_barang'] = 'Stok/tambah_barang';
$route['stok/daftar_barang'] = 'stok/daftar_barang';
$route['stok/update_barang/(:num)'] = 'stok/update_barang/$1';
$route['stok/simpan_update_barang'] = 'stok/simpan_update_barang';
$route['stok/hapus_barang/(:num)'] = 'stok/hapus_barang/$1';
$route['transaksi/tambah'] = 'transaksi/tambah';
$route['transaksi/simpan'] = 'transaksi/simpan';
$route['transaksi/daftar'] = 'transaksi/daftar';
$route['transaksi/hapus'] = 'transaksi/hapus';
$route['stok/real'] = 'stok/stok_real';
$route['transaksi/edit/(:num)'] = 'transaksi/edit/$1'; // Halaman edit
$route['transaksi/update/(:num)'] = 'transaksi/update/$1'; // Aksi update




