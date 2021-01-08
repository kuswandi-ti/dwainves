<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/login2', function () {
//     return view('auth.login2');
// });

// Auth //
Route::get('/', 'New_Auth\LoginController@index')->name('login');
Route::post('/postlogin', 'New_Auth\LoginController@postlogin')->name('postlogin');
Route::get('/logout', 'New_Auth\LoginController@logout')->name('logout');

Route::get('/register', 'New_Auth\RegisterController@register')->name('register');
Route::post('/postregister', 'New_Auth\RegisterController@postregister')->name('postregister');

// Dummy PDF Report  //
Route::get('/generate-pdf', 'Main\PDFController@generate_pdf');

// Receiving Report //
// Route::get('/generate-receiving-report', 'Main\PDFController@receiving_print');
Route::get('/generate-receiving-report-retur', 'Main\PDFController@receiving_retur_print');

// Receiving Cerificate //
Route::get('/receiving-certificate', 'Main\PDFController@receiving_certificate');

// Certificate Invoice //
Route::get('/certificate-invoice', 'Main\PDFController@certificate_invoice');

// QR Code Testing //
Route::get('/generate-qr', 'Main\PDFController@generate_qr');

// Route::get('/qrcode', function () {
//     return QrCode::size(250)
//         ->backgroundColor(255, 255, 204)
//         ->generate('report.qr');
// });

Route::group(['middleware' => 'LoginCheck'], function () {
    Route::get('/dashboard', 'Main\MenuController@index')->name('dashboard');

    Route::get('/setting-profile', 'Main\DataUserController@setting_profile')->name('setting');
    Route::get('/setting-profile/change-password', 'Main\DataUserController@change_password')->name('ubah-password');
    Route::post('/setting-profile/change-password/update-password', 'Main\DataUserController@update_password')->name('update-password');

    Route::get('/menu-user', 'Main\DataUserController@index')->name('menu-user');
    Route::post('/menu-user/data_user', 'Main\DataUserController@data_user');

    Route::get('/menu-user/add_data_user', 'Main\DataUserController@add_data')->name('add_data_user');
    Route::post('/menu-user/store_data', 'Main\DataUserController@store_data')->name('store_data_user');

    Route::get('/menu-user/hapus_data_user/{id}', 'Main\DataUserController@hapus_data_user')->name('hapus_data_user');
    Route::get('/menu-user/edit_data_user/{id}', 'Main\DataUserController@edit_data_user')->name('edit_data_user');

    Route::post('/menu-user/update_data_user', 'Main\DataUserController@update_data_user')->name('update_data_user');

    Route::get('/receiving-report', 'Transaction\ReceivingReportController@index')->name('receiving_report_index');
    Route::post('/receiving-report/list_receiving_report_hdr', 'Transaction\ReceivingReportController@list_receiving_report_hdr')->name('list_receiving_report_hdr');
    Route::get('/receiving-report/input_receiving_report', 'Transaction\ReceivingReportController@input_receiving_report')->name('input_receiving_report');
    Route::get('/receiving-report/get_rdi_gr_os_detail/{rdi_id}', 'Transaction\ReceivingReportController@get_rdi_gr_os_detail')->name('get_rdi_gr_os_detail');
    Route::post('/receiving-report/store_receiving_report', 'Transaction\ReceivingReportController@store_receiving_report')->name('store_receiving_report');
    Route::get('/receiving-report/print_receiving_report/{rr_id}', 'Transaction\ReceivingReportController@print_receiving_report')->name('print_receiving_report');

    Route::get('/certificate-of-invoice', 'Transaction\CertificateOfInvoiceController@index')->name('certificate_of_invoice_index');
    Route::post('/certificate-of-invoice/list_certificate_of_invoice_hdr', 'Transaction\CertificateOfInvoiceController@list_certificate_of_invoice_hdr')->name('list_certificate_of_invoice_hdr');
    Route::get('/certificate-of-invoice/input_certificate_of_invoice', 'Transaction\CertificateOfInvoiceController@input_certificate_of_invoice')->name('input_certificate_of_invoice');
    Route::get('/certificate-of-invoice/get_data_plo', 'Transaction\CertificateOfInvoiceController@get_data_plo')->name('get_data_plo');
    Route::get('/certificate-of-invoice/get_data_rdi/{plo_id}', 'Transaction\CertificateOfInvoiceController@get_data_rdi')->name('get_data_rdi');
    Route::post('/certificate-of-invoice/scan_faktur_pajak', 'Transaction\CertificateOfInvoiceController@scan_faktur_pajak')->name('scan_faktur_pajak');
    Route::post('/certificate-of-invoice/store_certificate_of_invoice_tmp', 'Transaction\CertificateOfInvoiceController@store_certificate_of_invoice_tmp')->name('store_certificate_of_invoice_tmp');
    Route::post('/certificate-of-invoice/store_certificate_of_invoice', 'Transaction\CertificateOfInvoiceController@store_certificate_of_invoice')->name('store_certificate_of_invoice');
    Route::get('/certificate-of-invoice/list_certificate_of_invoice_tmp', 'Transaction\CertificateOfInvoiceController@list_certificate_of_invoice_tmp')->name('list_certificate_of_invoice_tmp');    
    Route::delete('/certificate-of-invoice/delete_invoice_no_tmp/{invoice_no}', 'Transaction\CertificateOfInvoiceController@delete_invoice_no_tmp')->name('delete_invoice_no_tmp');
    Route::get('/certificate-of-invoice/get_detail_invoice_tmp/{invoice_no}', 'Transaction\CertificateOfInvoiceController@get_detail_invoice_tmp')->name('get_detail_invoice_tmp');
    Route::get('/certificate-of-invoice/get_detail_rdi/{sysid_rdi}', 'Transaction\CertificateOfInvoiceController@get_detail_rdi')->name('get_detail_rdi');
    Route::get('/certificate-of-invoice/print_certificate_of_invoice/{coi_id}', 'Transaction\CertificateOfInvoiceController@print_certificate_of_invoice')->name('print_certificate_of_invoice');
});
