$(document).ready(function() {

	reset_input();
	populate_plo();	

	function list_certificate_of_invoice_tmp() {
		$.ajax({
			url: "/certificate-of-invoice/list_certificate_of_invoice_tmp",
			type: 'GET',
			datatype: 'json',
			beforeSend: function() {
				$("#detail_invoice_tmp").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#detail_invoice_tmp").LoadingOverlay("hide", true);
			},
			success: function(data) {
				$("#detail_invoice_tmp").empty();
				var html = '';
				var i = 0;
				if ($.isEmptyObject(data)) {
					html +=	'<tr>';
		            html +=     '<td colspan="9" class="text-center"><b>Tidak Ada Data</b></td>';
		            html +=	'</tr>';
				} else {					
		            data.forEach(function(row) {
			            html +=	'<tr>';
			            html +=     '<td class="text-center">'+row.plo_no+
		                				'<input type="hidden" value="'+row.plo_no+'" id="plo_no_tmp[]" name="plo_no_tmp[]" class="form-control" readonly>';
			            html +=		'</td>';
		                html +=     '<td class="text-center">'+row.invoice_no+
		                				'<input type="hidden" value="'+row.invoice_no+'" id="invoice_no_tmp[]" name="invoice_no_tmp[]" class="form-control" readonly>';
			            html +=		'</td>';
		                html +=     '<td class="text-center">'+moment(row.invoice_date).format(format_date_display_2)+
		                				'<input type="hidden" value="'+moment(row.invoice_date).format(format_date_display_3)+'" id="invoice_date_tmp[]" name="invoice_date_tmp[]" class="form-control" readonly>';
		                html +=     '</td>';
		                html +=     '<td class="text-center">'+row.faktur_name+
		                				'<input type="hidden" value="'+row.faktur_name+'" id="faktur_name_tmp[]" name="faktur_name_tmp[]" class="form-control" readonly>';
			            html +=		'</td>';
		                html +=     '<td class="text-center">'+moment(row.faktur_date).format(format_date_display_2)+
		                				'<input type="hidden" value="'+moment(row.faktur_date).format(format_date_display_3)+'" id="faktur_date_tmp[]" name="faktur_date_tmp[]" class="form-control" readonly>';
		                html +=     '</td>';
		                html +=     '<td class="text-right">'+currencyFormat(row.dpp)+
		                				'<input type="hidden" value="'+row.dpp+'" id="dpp_tmp[]" name="dpp_tmp[]" class="form-control" readonly>';
		                html +=     '</td>';
		                html +=     '<td class="text-right">'+currencyFormat(row.ppn)+
		                				'<input type="hidden" value="'+row.ppn+'" id="ppn_tmp[]" name="ppn_tmp[]" class="form-control" readonly>';
		                html +=     '</td>';
		                html +=     '<td class="text-right">'+currencyFormat(row.total)+
		                				'<input type="hidden" value="'+row.total+'" id="total_tmp[]" name="total_tmp[]" class="form-control" readonly>';
		                html +=     '</td>';
		                html +=     '<td class="text-center">'+
		                				"<a style='font-size:14px;font-weight:bold' href='javascript:void(0)' id='detail_inv' data-toggle='tooltip' title='Detail Invoice' data-invoice_no='"+row.invoice_no+"' data-original-title='Detail Invoice' class='detail_inv btn btn-success btn-sm'><i class='fas fa-eye'></i></a>"+
                                        "<a style='font-size:14px;font-weight:bold' href='javascript:void(0)' id='delete_inv' data-toggle='tooltip' title='Delete Invoice' data-invoice_no='"+row.invoice_no+"' data-original-title='Delete Invoice' class='delete_inv btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>"+
									'</td>';
			            html +=	'</tr>';
				     	i = i+1;
					});
				}
				$('#detail_invoice_tmp').html(html);
			},
			error: function(xhr, status, error) {
				$("#detail_invoice_tmp").LoadingOverlay("hide", true);
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});
	}

	function populate_plo() {
		$.ajax({
			url: "/certificate-of-invoice/get_data_plo",
			type: 'GET',
			datatype: 'json',
			beforeSend: function() {
				$("#detail_input_plo").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#detail_input_plo").LoadingOverlay("hide", true);
			},
			success: function(data) {
				$("#detail_input_plo").empty();
				if ($.isEmptyObject(data)) {
					$('#detail_input_plo').append('<h1 class="text-center text-danger">Tidak ada data</h1>');
				} else {					
					var html = '';
					html +=	'<select name="cbo_nomor_plo" id="cbo_nomor_plo" class="form-control select2">';
					html += 	'<option value="0" data-id="0">-- Pilih Nomor PLO --</option>';
								data.forEach(function(row) {
					html +=			'<option value="'+row.PO_No+'" data-id="'+parseInt(row.SysId)+'" data-date="'+row.PO_Date+'">'+row.PO_No+'</option>';
								});
					html += '</select>';
					$('#detail_input_plo').html(html);
				}
				$("#cbo_nomor_plo").select2();
			},
			error: function(xhr, status, error) {
				$("#detail_input_plo").LoadingOverlay("hide", true);
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});
	}
	/* List Data - End */

	/* Event - Begin */
	$('body').on('change', '#cbo_nomor_plo', function () {
		var plo_id = $('#cbo_nomor_plo option:selected').attr('data-id');

		$.ajax({
			url: "/certificate-of-invoice/get_data_rdi/"+plo_id,
			type: 'GET',
			datatype: 'json',
			beforeSend: function() {
				$("#detail_input_rdi").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#detail_input_rdi").LoadingOverlay("hide", true);
			},
			success: function(data) {
				$("#detail_input_rdi").empty();
				if (plo_id == '0') {
					return false;
				}
				if ($.isEmptyObject(data)) {
					$('#detail_input_rdi').append('<h1 class="text-center text-danger">Tidak ada data</h1>');
				} else {					
					var html = '';
					var i = 0;

					html += 	'<hr>';
					html += 	'<div class="table-responsive">';
		            html += 		'<table class="table table-striped" id="table_rdi">';
		            html += 			'<thead>';
		            html += 				'<tr>';
		            // html += 					'<th class="text-center"><input type="checkbox" class="text-center" id="check_all" checked></th>';
		            html += 					'<th class="text-center">#</th>';
	                html +=                   	'<th class="text-center">Nomor DI</th>';
	                html +=                 	'<th class="text-center">Tanggal DI</th>';
	                html +=                 	'<th class="text-center">DPP</th>';
	                html +=                 	'<th class="text-center">PPN</th>';
	                html +=                 	'<th class="text-center">Total</th>';
	                html +=                    	'<th class="text-center">Detail</th>';
		            html += 				'</tr>';
		            html += 			'</thead>';
		            html += 			'<tbody>';
								            data.forEach(function(row) {
									            html +=	'<tr>';
									            html +=		'<td class="text-center"><input type="checkbox" class="text-center" id="chk_select[]" name="chk_select[]" value="'+i+'">';
									            html +=			'<input type="hidden" value="'+parseInt(row.SysId_RDI)+'" id="sysid_rdi[]" name="sysid_rdi[]" class="form-control" readonly>';
									            html +=		'</td>';
								                html +=     '<td class="text-center">'+row.No_RDI+
								                				'<input type="hidden" value="'+row.No_RDI+'" id="no_rdi[]" name="no_rdi[]" class="form-control" readonly>';
									            html +=		'</td>';
								                html +=     '<td class="text-center">'+moment(row.Tanggal_RDI).format(format_date_display_2)+
								                				'<input type="hidden" value="'+moment(row.Tanggal_RDI).format(format_date_display_3)+'" id="tgl_rdi[]" name="tgl_rdi[]" class="form-control" readonly>';
								                html +=     '</td>';
								                html +=     '<td class="text-center">'+currencyFormat(row.DPP)+
								                				'<input type="hidden" value="'+row.DPP+'" id="dpp_rdi[]" name="dpp_rdi[]" class="form-control" readonly>';
								                html +=     '</td>';
								                html +=     '<td class="text-center">'+currencyFormat(row.PPN)+
								                				'<input type="hidden" value="'+row.PPN+'" id="ppn_rdi[]" name="ppn_rdi[]" class="form-control" readonly>';
								                html +=     '</td>';
								                html +=     '<td class="text-center">'+currencyFormat(parseFloat(row.DPP) + parseFloat(row.PPN))+
								                				'<input type="hidden" value="'+(parseFloat(row.DPP) + parseFloat(row.PPN))+'" id="total_rdi[]" name="total_rdi[]" class="form-control" readonly>';
								                html +=     '</td>';
								                html +=     '<td class="text-center">';
								                html +=			"<a href='javascript:void(0)' id='detail_rdi' data-toggle='tooltip' title='Detail Delivery Instruction' data-sysid_rdi='"+parseInt(row.SysId_RDI)+"' data-no_rdi='"+row.No_RDI+"' data-original-title='Detail Delivery Instruction' class='detail_rdi btn btn-success btn-sm'><i class='fas fa-eye'></i></a>";
								                html +=     '</td>';
									            html +=	'</tr>';
										     	i = i+1;
											});
		            html += 			'</tbody>';
		            html += 		'</table>';
		            html +=		'</div>';
		            html +=		'<hr>';
		            html +=		'<div class="row">';
                    html +=     	'<div class="col-xs-12 col-md-6 col-lg-7 col-xl-7">&nbsp;</div>';
                    html +=     	'<div class="col-xs-12 col-md-5 col-lg-5 col-xl-5">';
		            html +=				'<div class="form-group row">';
                    html +=					'<label for="total_dpp_rdi" class="col-sm-3 col-form-label text-right">Total DPP</label>';
                    html +=					'<div class="col-sm-9">';
                    html +=						'<input type="text" class="form-control text-right" id="total_dpp_rdi" name="total_dpp_rdi" value="0" readonly>';
                    html +=					'</div>';
                    html +=				'</div>';
                    html +=				'<div class="form-group row">';
                    html +=					'<label for="total_ppn_rdi" class="col-sm-3 col-form-label text-right">Total PPN</label>';
                    html +=					'<div class="col-sm-9">';
                    html +=						'<input type="text" class="form-control text-right" id="total_ppn_rdi" name="total_ppn_rdi" value="0" readonly>';
                    html +=					'</div>';
                    html +=				'</div>';
                    html +=				'<div class="form-group row" style="display:none;">';
                    html +=					'<label for="grand_total_rdi" class="col-sm-3 col-form-label text-right">Grand Total</label>';
                    html +=					'<div class="col-sm-9">';
                    html +=						'<input type="text" class="form-control text-right" id="grand_total_rdi" name="grand_total_rdi" value="0" readonly>';
                    html +=					'</div>';
                    html +=				'</div>';
                    html +=			'</div>';
                    html +=		'</div>';
					
					$('#detail_input_rdi').html(html);
				}
			},
			error: function(xhr, status, error) {
				$("#detail_input_rr").LoadingOverlay("hide", true);
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});
    });

	$('body').on('click', '#check_all', function () {
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});

	$('#no_faktur_pajak').keypress(function(event) {
		var var_link = $('#no_faktur_pajak').val();

		$.ajax({
			type		: 'post',
			url			: "/certificate-of-invoice/scan_faktur_pajak",
			dataType 	: 'json',
			data 		: {
				link : var_link,
			},
			beforeSend: function() {
				$("#card_faktur_pajak").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#card_faktur_pajak").LoadingOverlay("hide", true);
			},
			success: function(response) {
				for (var key in response) {
					var flag 			= (response['success']);
					var message 		= (response['message']);
					var data 			= (response['data']);
				}
				if ($.trim(flag) == 'true') {
					$('#no_faktur_pajak').val('');
					if ($.isEmptyObject(data.nomorFaktur)) {
						$("#card_faktur_pajak").LoadingOverlay("hide", true);
						$('#kode_jenis_transaksi').val('');
						$('#fg_pengganti').val('');
						$('#nomor_faktur').val('');
						$('#tanggal_faktur').val('');
						$('#dpp_faktur').val('');
						$('#ppn_faktur').val('');
						$('#detail_input_faktur_pajak').empty();
						Swal.fire({
						   	type 		: 'warning',
							title 		: '<strong>Perhatian</strong>',
						   	text 		: "Nomor Faktur Pajak tidak ada data !!!",
					   	});
					} else {
						var str_tanggal_faktur = data.tanggalFaktur;
						$('#kode_jenis_transaksi').val(data.kdJenisTransaksi);
						$('#fg_pengganti').val(data.fgPengganti);
						$('#nomor_faktur').val(data.nomorFaktur);
						$('#tanggal_faktur').val(str_tanggal_faktur.replaceAll("/", "-"));
						$('#dpp_faktur').val(currencyFormat(data.jumlahDpp));
						$('#ppn_faktur').val(currencyFormat(data.jumlahPpn));

						$('#detail_input_faktur_pajak').empty();

						// console.log(Object.entries(data.detailTransaksi));
						// console.log(data.detailTransaksi);
						// $.each(data.detailTransaksi, function(key, value) {
            				// console.log(key + " : " + value);
        				// });
						// console.log(Object.values(data.detailTransaksi).length);
						// console.log(data.detailTransaksi);

						obj_length = Object.values(data.detailTransaksi).length;
						var html = '';
						var i = 0;
						html +=	'<hr>';
                        html +=	'<div class="table-responsive">';
                        html +=		'<table class="table table-striped" id="tabel_detail_faktur_pajak">';
                        html +=			'<thead>';
                        html += 			'<tr>';
                        html += 				'<th class="text-center">No.</th>';
                        html += 				'<th>Nama Barang</th>'
                        html += 				'<th class="text-right">Harga</th>';
                        html +=					'<th class="text-right">Jumlah</th>';
                        html +=					'<th class="text-right">Diskon</th>';
                        html +=					'<th class="text-right" style="display:none;">Total</th>';
                        html +=					'<th class="text-right">DPP</th>';
                        html +=					'<th class="text-right">PPN</th>';
                        html +=				'</tr>';
                        html +=			'</thead>';
                        html +=			'<tbody>';
                        					if ($.isArray(data.detailTransaksi)) {
                        						$.each(data.detailTransaksi , function(index, item) {
					                            	i = i+1;
					                            	html += '<tr>';
					                                html += 	'<td class="text-center">'+i+'</td>';
					                                html += 	'<td>'+item.nama+
					                                				'<input type="hidden" value="'+item.nama+'" id="nama_barang_faktur[]" name="nama_barang_faktur[]" class="form-control" readonly>'+
					                                			'</td>';
					                                html += 	'<td class="text-right">'+currencyFormat(item.hargaSatuan)+
					                                				'<input type="hidden" value="'+item.hargaSatuan+'" id="harga_satuan_faktur[]" name="harga_satuan[]_faktur" class="form-control" readonly>'+
					                                			'</td>';
					                                html += 	'<td class="text-right">'+currencyFormat(item.jumlahBarang)+
					                                				'<input type="hidden" value="'+item.jumlahBarang+'" id="jumlah_barang_faktur[]" name="jumlah_barang_faktur[]" class="form-control" readonly>'+
					                                			'</td>';
					                                html += 	'<td class="text-right">'+currencyFormat(item.diskon)+
					                                				'<input type="hidden" value="'+item.diskon+'" id="diskon_faktur[]" name="diskon_faktur[]" class="form-control" readonly>'+
					                                			'</td>';
					                                html += 	'<td class="text-right" style="display:none;">'+currencyFormat(item.hargaTotal)+
					                                				'<input type="hidden" value="'+item.hargaTotal+'" id="harga_total_faktur[]" name="harga_total_faktur[]" class="form-control" readonly>'+
					                                			'</td>';
					                                html += 	'<td class="text-right">'+currencyFormat(item.dpp)+
					                                				'<input type="hidden" value="'+item.dpp+'" id="dpp_detail_faktur[]" name="dpp_detail_faktur[]" class="form-control" readonly>'+
					                                			'</td>';
					                                html += 	'<td class="text-right">'+currencyFormat(item.ppn)+
					                                				'<input type="hidden" value="'+item.ppn+'" id="ppn_detail_faktur[]" name="ppn_detail_faktur[]" class="form-control" readonly>'+
					                                			'</td>';
					                                html += '</tr>';				                                
												});

                        					} else {
                        						/*
                        						  0 = nama : High Performance Cloth (uk. 30x30cm)
												  1 = hargaSatuan : 25000
												  2 = jumlahBarang : 96
												  3 = hargaTotal : 2400000
												  4 = diskon : 0
												  5 = dpp : 2400000
												  6 = ppn : 240000
												  7 = tarifPpnbm : 0
												  8 = ppnbm : 0
												*/
                        						var arr = [];
                        						$.each(data.detailTransaksi, function(key, value) {
						            				arr.push(value);
						        				});
						        				html += '<tr>';
				                                html += 	'<td class="text-center">1</td>';
				                                html += 	'<td>'+arr[0]+
				                                				'<input type="hidden" value="'+arr[0]+'" id="nama_barang_faktur[]" name="nama_barang_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += 	'<td class="text-right">'+currencyFormat(arr[1])+
				                                				'<input type="hidden" value="'+arr[1]+'" id="harga_satuan_faktur[]" name="harga_satuan_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += 	'<td class="text-right">'+currencyFormat(arr[2])+
				                                				'<input type="hidden" value="'+arr[2]+'" id="jumlah_barang_faktur[]" name="jumlah_barang_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += 	'<td class="text-right">'+currencyFormat(arr[4])+
				                                				'<input type="hidden" value="'+arr[4]+'" id="diskon_faktur[]" name="diskon_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += 	'<td class="text-right" style="display:none;">'+currencyFormat(arr[3])+
				                                				'<input type="hidden" value="'+arr[3]+'" id="harga_total_faktur[]" name="harga_total_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += 	'<td class="text-right">'+currencyFormat(arr[5])+
				                                				'<input type="hidden" value="'+arr[5]+'" id="dpp_detail_faktur[]" name="dpp_detail_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += 	'<td class="text-right">'+currencyFormat(arr[6])+
				                                				'<input type="hidden" value="'+arr[6]+'" id="ppn_detail_faktur[]" name="ppn_detail_faktur[]" class="form-control" readonly>'+
				                                			'</td>';
				                                html += '</tr>';
                        					}				                            
                        html +=			'</tbody>';
                        html +=		'</table>';
                        html +=	'</div>';
						$('#detail_input_faktur_pajak').html(html);
						$("#card_faktur_pajak").LoadingOverlay("hide", true);
					}
				} else {
					$('#no_faktur_pajak').val('');
					$("#card_faktur_pajak").LoadingOverlay("hide", true);
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: '<u>Kemungkinan error :</u> <br>'+
									   message,
					});
				}
			},
			error: function(xhr, status, error) {
				$('#no_faktur_pajak').val('');
				var errorMessage = xhr.status + ': ' + xhr.statusText
				$("#card_faktur_pajak").LoadingOverlay("hide", true);
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});
	});

	$('body').on('click', '#tambah_coi', function () {
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});

	$('body').on('click', '#tambah_coi', function (e) {
		e.preventDefault();

		var plo_id 				= $('#cbo_nomor_plo option:selected').attr('data-id');
		var plo_no 				= $('#cbo_nomor_plo option:selected').text();
		var count_check_di 		= $('input[name="chk_select[]"]:checked').length;
		var nomor_faktur 		= $('#nomor_faktur').val();
		var no_invioce_supplier = $('#no_invoice_supplier').val();
		var tgl_invoice 		= $('#tanggal_invoice_supplier').val();
		var tgl_faktur_pajak	= $('#tanggal_faktur').val();
		var amount_dpp_rdi 		= amountToFloat($('#total_dpp_rdi').val());
		var amount_dpp_faktur	= amountToFloat($('#dpp').val());

		if (plo_id == 0) {
			Swal.fire({
			   	type 		: 'warning',
				title 		: '<strong>Perhatian</strong>',
			   	text 		: "Plan Order (PLO) belum dipilih !!!",
		   	});
		   	return false;
		}

		if (count_check_di == 0) {
			Swal.fire({
			   	type 		: 'warning',
				title 		: '<strong>Perhatian</strong>',
			   	text 		: "Delivery Instruction (DI) belum ada yang dipilih !!!",
		   	});
		   	return false;
		}

		if (nomor_faktur.length == 0) {
			Swal.fire({
			   	type 		: 'warning',
				title 		: '<strong>Perhatian</strong>',
			   	text 		: "Faktur pajak belum discan !!!",
		   	});
		   	return false;
		}

		if (no_invioce_supplier.length == 0) {
			Swal.fire({
			   	type 		: 'warning',
				title 		: '<strong>Perhatian</strong>',
			   	text 		: "No Invoice Supplier belum diisi !!!",
		   	});
		   	return false;
		}

		if (tgl_invoice != tgl_faktur_pajak) {
			Swal.fire({
			   	type 		: 'warning',
				title 		: '<strong>Perhatian</strong>',
			   	text 		: "Tanggal Invoice Supplier tidak sama dengan Tanggal Faktur Pajak !!!",
		   	});
		   	return false;
		}

		// if (amount_dpp_rdi != amount_dpp_faktur) {
		// 	Swal.fire({
		// 	   	type 		: 'warning',
		// 		title 		: '<strong>Perhatian</strong>',
		// 	   	text 		: "DPP Invoice Supplier tidak sama dengan DPP Faktur Pajak !!!",
		//    	});
		//    	return false;
		// }

  		var no_inv_supplier 	= $('#no_invoice_supplier').val();
  		var tgl_inv_supplier 	= $('#tanggal_invoice_supplier').val();
  		var no_faktur 			= $('#nomor_faktur').val();
  		var tgl_faktur 			= $('#tanggal_faktur').val();
  		var dpp_rdi 			= amountToFloat($('#total_dpp_rdi').val());
  		var ppn_rdi 			= amountToFloat($('#total_ppn_rdi').val());
  		var total_rdi 			= dpp_rdi + ppn_rdi;

  		$.ajax({
			type		: 'post',
			url			: "/certificate-of-invoice/store_certificate_of_invoice_tmp",
			data		: $('#form_input_coi').serialize(),
			beforeSend: function() {
				$.LoadingOverlay("show");
			},
			complete: function() {
				$.LoadingOverlay("hide");
			},
			success: function(response) {
				for (var key in response) {
					var flag 			= (response['success']);
					var message 		= (response['message']);
				}		
				if ($.trim(flag) == 'true') {
			  		reset_input();	  		
			  		iziToast.success({
					    title: 'OK',
					    message: 'Sukses menambah data!',
					    position: 'topRight',
					});
				} else {
					Swal.fire({
						type 		: 'error',
						title 		: '<strong>Error</strong>',
						html 		: '<u>Kemungkinan error :</u> <br>'+
									   message,
					});
				}
			},
			error: function(xhr, status, error) {
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});
	});

	$('body').on('click', '#reset_coi', function (e) {
		e.preventDefault();
  		swal({
            title: "Reset input Certificate of Invoice ?",
            text: "Data yang sudah diinput akan direset !",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                reset_input();
        		$("#cbo_nomor_plo").focus();
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
	});

	$('body').on('click', '.delete_inv', function (e) {
		e.preventDefault();

		var table 		= $("#tabel_invoice_tmp").DataTable();
		var data 		= table.row(this).data();
		var invoice_no 	= $(this).data("invoice_no");

  		swal({
            title: "Hapus input Certificate of Invoice ?",
            text: "Data yang sudah diinput akan dihapus !",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
            	$.ajax({
					type		: 'delete',
					url			: "/certificate-of-invoice/delete_invoice_no_tmp/" + invoice_no,
					data: {
			            "invoice_no": invoice_no,
			        },
					beforeSend: function() {
						$.LoadingOverlay("show");
					},
					complete: function() {
						$.LoadingOverlay("hide");
					},
					success: function(response) {
						for (var key in response) {
							var flag 			= (response['success']);
							var message 		= (response['message']);
						}		
						if ($.trim(flag) == 'true') {
					  		list_certificate_of_invoice_tmp();
					  		iziToast.success({
							    title: 'OK',
							    message: 'Sukses menghapus data!',
							    position: 'topRight',
							});
						} else {
							Swal.fire({
								type 		: 'error',
								title 		: '<strong>Error</strong>',
								html 		: '<u>Kemungkinan error :</u> <br>'+
											   message,
							});
						}
					},
					error: function(xhr, status, error) {
						var errorMessage = xhr.status + ': ' + xhr.statusText
					   	Swal.fire({
						   	type 		: 'error',
							title 		: '<strong>Error</strong>',
						   	text 		: errorMessage,
					   	});
					}
				}).always(function(){
		    		$.LoadingOverlay("hide");
				});
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
	});

	$('body').on('click', '.detail_rdi', function (e) {
		e.preventDefault();
		var sysid_rdi	= $(this).closest('[data-sysid_rdi]').data('sysid_rdi');
		var no_rdi 		= $(this).closest('[data-no_rdi]').data('no_rdi');

		$.ajax({
			url: "/certificate-of-invoice/get_detail_rdi/" + sysid_rdi,
			type: 'GET',
			datatype: 'json',
			beforeSend: function() {
				$("#detail_modal_rdi").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#detail_modal_rdi").LoadingOverlay("hide", true);
			},
			success: function(data) {
				$("#detail_modal_rdi").empty();
				var html = '';
				var i = 0;
				if ($.isEmptyObject(data)) {
					html +=	'<tr>';
	                html +=     '<td colspan="7" class="text-center"><b>Tidak ada data</b></td>';
		            html +=	'</tr>';
				} else {					
		            data.forEach(function(row) {
		            	i = i+1;
			            html +=	'<tr>';
			            html +=     '<td class="text-center">'+i+'</td>';
		                html +=     '<td class="text-center">'+row.Part_Number+'</td>';
		                html +=     '<td class="text-left">'+row.Part_Name+'</td>';
		                html +=     '<td class="text-center">'+row.Unit+'</td>';
		                html +=     '<td class="text-right">'+currencyFormat(row.Qty_DI)+'</td>';
		                html +=     '<td class="text-right">'+currencyFormat(row.Price)+'</td>';
		                html +=     '<td class="text-right">'+currencyFormat(row.Total)+'</td>';
			            html +=	'</tr>';				     	
					});
				}
				$('#detail_modal_rdi').html(html);
			},
			error: function(xhr, status, error) {
				$("#detail_modal_rdi").LoadingOverlay("hide", true);
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});

		$("#title_modal_detail_rdi").html('Detail Delivery Instruction No. <span class="text-danger">' + no_rdi + '</span>');
		$("#modal_detail_rdi").modal('show');
	});

	$('body').on('click', '#table_rdi input[type="checkbox"]', function () {
		var array 		= [];
		var total_dpp 	= 0;
		var total_ppn 	= 0;
		var total_all 	= 0;

  		$('#table_rdi').find('input[type="checkbox"]:checked').each(function () {  			
  			var row 	= $(this).closest('tr');
       		var sysid 	= $(this).val();
  			var dpp 	= amountToFloat(row.find('td:eq(3)').text());
  			var ppn 	= amountToFloat(row.find('td:eq(4)').text());
  			var total 	= amountToFloat(row.find('td:eq(5)').text());
        	array.push({"sysid_rdi": sysid, "dpp": dpp, "ppn": ppn, "total": total});
    	});

 		
 		$.each(array , function(index, item) {
 			total_dpp = total_dpp + item.dpp;
 			total_ppn = total_ppn + item.ppn;
 			total_all = total_all + item.total;
 		});
 		$('#total_dpp_rdi').val(currencyFormat(total_dpp));
 		$('#total_ppn_rdi').val(currencyFormat(total_ppn));
 		$('#grand_total_rdi').val(currencyFormat(total_all));
	});

	$('body').on('click', '.detail_inv', function (e) {
		e.preventDefault();

		var table 		= $("#tabel_invoice_tmp").DataTable();
		var data 		= table.row(this).data();
		var invoice_no 	= $(this).data("invoice_no");

		$.ajax({
			url: "/certificate-of-invoice/get_detail_invoice_tmp/" + invoice_no,
			type: 'GET',
			datatype: 'json',
			beforeSend: function() {
				$("#detail_modal_invoice_tmp").LoadingOverlay("show", true);
			},
			complete: function() {
				$("#detail_modal_invoice_tmp").LoadingOverlay("hide", true);
			},
			success: function(data) {
				$("#detail_modal_invoice_tmp").empty();
				var html = '';
				var i = 0;
				if ($.isEmptyObject(data)) {
					html +=	'<tr>';
	                html +=     '<td colspan="2" class="text-center"><b>Tidak ada data</b></td>';
		            html +=	'</tr>';
				} else {					
		            data.forEach(function(row) {
			            html +=	'<tr>';
		                html +=     '<td class="text-center">'+row.rdi_no+'</td>';
		                html +=     '<td class="text-center">'+moment(row.rdi_date).format(format_date_display_2)+'</td>';
			            html +=	'</tr>';
				     	i = i+1;
					});
				}
				$('#detail_modal_invoice_tmp').html(html);
			},
			error: function(xhr, status, error) {
				$("#detail_modal_invoice_tmp").LoadingOverlay("hide", true);
				var errorMessage = xhr.status + ': ' + xhr.statusText
			   	Swal.fire({
				   	type 		: 'error',
					title 		: '<strong>Error</strong>',
				   	text 		: errorMessage,
			   	});
			}
		}).always(function(){
    		$.LoadingOverlay("hide");
		});

		$("#title_modal_detail_invoice_tmp").html('Detail Invoice No. ' + invoice_no);
		$("#modal_detail_invoice_tmp").modal('show');
	});

	$('body').on('click', '#create_coi', function (e) {
		e.preventDefault();

  		swal({
            title: "Lanjutkan proses pembuatan Certificate of Invoice ?",
            text: "Proses pembuatan Certificate of Invoice",
            type: "question",
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
					type		: 'post',
					url			: "/certificate-of-invoice/store_certificate_of_invoice",
					data		: $('#form_input_coi').serialize(),
					beforeSend: function() {
						$.LoadingOverlay("show");
					},
					complete: function() {
						$.LoadingOverlay("hide");
					},
					success: function(response) {
						for (var key in response) {
							var flag 			= (response['success']);
							var message 		= (response['message']);
							var coi_id 	    	= (response['coi_id']);
							var coi_no 	    	= (response['coi_no']);
						}		
						if ($.trim(flag) == 'true') {
							var url = '/certificate-of-invoice';
							swal({								
					            title				: "Success!",
					            html				: message +
					            	  				  '<br>Nomor Certificate Of Invoice : <strong>' +
								      				  coi_no +
								      				  '</strong><br><br>Lanjutkan ke proses print COI ?',
					            type 				: 'success',
					            showCancelButton	: !0,
					            confirmButtonText	: "Ya",
					            cancelButtonText	: "Tidak",
					            reverseButtons		: !0
					        }).then(function (e) {
					            if (e.value === true) {
					            	window.open("/certificate-of-invoice/print_certificate_of_invoice/" + coi_id, "_blank");
					            } else {
					                e.dismiss;
					            }
					            window.location.replace(url);
					        }, function (dismiss) {
					            window.location.replace(url);
					        })
						} else {
							Swal.fire({
								type 		: 'error',
								title 		: '<strong>Error</strong>',
								html 		: '<u>Kemungkinan error :</u> <br>'+
											   message,
							});
						}
					},
					error: function(xhr, status, error) {
						var errorMessage = xhr.status + ': ' + xhr.statusText
					   	Swal.fire({
						   	type 		: 'error',
							title 		: '<strong>Error</strong>',
						   	text 		: errorMessage,
					   	});
					}
				}).always(function(){
		    		$.LoadingOverlay("hide");
				});
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
	});
	/* Event - End */

	/* Function - Begin */
    function reset_input() {
    	$(".select2").select2().val('0').trigger("change");
    	$("#detail_input_rdi").empty();

    	$('#no_faktur_pajak').val('');
    	$('#kode_jenis_transaksi').val('');
		$('#fg_pengganti').val('');
		$('#nomor_faktur').val('');
		$('#tanggal_faktur').val('');
		$('#dpp_faktur').val('');
		$('#ppn_faktur').val('');
		$('#detail_input_faktur_pajak').empty();

		$('#no_invoice_supplier').val('');
		$('#tanggal_invoice_supplier').val(moment().format(format_date_display_2));
		$('#detail_invoice_tmp').empty();

		list_certificate_of_invoice_tmp();
    }

});